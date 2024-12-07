<?php
namespace App\Controllers;
use App\Models\RegisterModel;

class RegisterController extends BaseController{
    public function __construct() {
        helper('cookie'); 
    }

    public function index(){
        return view('register_form');
    }

    public function create(){
        $response = ['status' => false, 'message' => ''];
        if ($this->request->isAJAX()) {
            $userModel = new RegisterModel();

            $validationRules = [
                'firstname' => 'required|min_length[3]|max_length[100]',
                'lastname'  => 'required|min_length[3]|max_length[100]',
                'email'     => 'required|valid_email|is_unique[user.email]',
                'gender' => 'required|in_list[Male,Female]',
                'city'    => 'required',
                'country'    => 'required',
                'password'   => 'required|min_length[6]',
               'profileImg' => 'uploaded[profileImg]|is_image[profileImg]|max_size[profileImg,2048]|mime_in[profileImg,image/jpg,image/jpeg,image/png,image/gif]',
               'image_name' => 'uploaded[image_name]|is_image[image_name]|max_size[image_name,2048]|mime_in[image_name,image/jpg,image/jpeg,image/png,image/gif]',
            ];
        
            if (!$this->validate($validationRules)) {
                return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
            }
         $user=$this->request->getPost();

         $profileImage = $this->request->getFile('profileImg');
         if ($profileImage && $profileImage->isValid()) {
             $profileImageName = $profileImage->getRandomName();
             $profileImage->move('public/uploads', $profileImageName);
             $user['profileImg'] = $profileImageName;
         }

         $multipleImages = $this->request->getFiles()['image_name'];
         $uploadedImages = [];
         foreach ($multipleImages as $file) {
             if ($file->isValid() && !$file->hasMoved()) {
                 $imageName = $file->getRandomName();
                 $file->move('public/uploads', $imageName);
                 $uploadedImages[] = $imageName;
             }
         }
         $user['image_name'] = json_encode($uploadedImages);
        $user['password']=password_hash($user['password'],PASSWORD_DEFAULT);

        if($userModel->insert($user)){
            $response['status'] = true;
            $response['message'] = 'Registration successful!';
        } else {
            $response['message'] = 'Failed to save user!';
        }
        
      
    }
    return $this->response->setJSON($response);
}
public function login(){
    return view('login_form');
    

}
public function createlogin(){
    $response = ['status' => false, 'message' => ''];

    if ($this->request->isAJAX()) {
     

        $email=$this->request->getVar('email');
        $password=$this->request->getVar('password');

        $userModel = new RegisterModel();
        $validationRules = [
           'email'     => 'required|valid_email',
           'password'   => 'required|min_length[6]',
          
        ];
    
        if (!$this->validate($validationRules)) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }
        $user=$userModel->where('email',$email)->first();
        if ($user && password_verify($password, $user['password'])) {
            
            $session = session();
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['firstname'],
                'is_logged_in' => true,
            ]);

               
            set_cookie('user_email', $email, 3600);

            $response['status'] = true;
            $response['message'] = 'Login successful!';
        } else {
            $response['message'] = 'Invalid email or password!';
        }
       
    }
    return $this->response->setJSON($response);
}
public function welcome(){
    {
        $session = session();
        if ($session->get('is_logged_in')) {
            return view('welcome', [
                'username' => $session->get('username') 
            ]);
        } else {
            return redirect()->to('/login'); 
        }
    }
}

public function logout(){
    $session = session();
    $session->destroy();
    delete_cookie('user_email');
    return redirect()->to('/login');
}
}


?>