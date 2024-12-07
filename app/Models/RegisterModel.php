<?php
namespace APP\Models;

use CodeIgniter\Model;

class RegisterModel extends Model{
    protected $table='user';
    protected $primaryKey = 'id';
    protected $allowedFields=['firstname','lastname','email','gender','city','country','password','profileImg','image_name'];
}
?>