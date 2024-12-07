<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<style>
		body {
			background-color: #f8f9fa;
		}

		.card {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}

		.form-control:focus {
			box-shadow: none;
			border-color: #007bff;
		}

		.input-group-text {
			background-color: darkgray;
			color: #fff;
			border: none;
		}

		.btn-primary {
			background-color: #132140;
			border: none;
		}

		
	</style>
</head>

<body>
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<header class="card-header  text-white text-center" style="background: #37486c;">
						<h4 class="card-title mt-2">Registration Form</h4>
					</header>
					<article class="card-body">
						<form id="registrationForm" method="POST" enctype="multipart/form-data">

							<!-- Name Section -->
							<div class="form-row">
								<div class="col form-group">
									<label for="firstname">First Name</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input type="text" class="form-control" placeholder="Enter your first name" id="firstname" name="firstname">
									</div>
                                    <div class="error-message text-danger" id="error-firstname"></div>
								</div>
								<div class="col form-group">
									<label for="lastname">Last Name</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input type="text" class="form-control" placeholder="Enter your last name" id="lastname" name="lastname">
									</div>
                                    <div class="error-message text-danger" id="error-lastname"></div>
								</div>
							</div>

							<!-- Email Section -->
							<div class="form-group">
								<label for="email">Email Address</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-envelope"></i></span>
									</div>
									<input type="email" class="form-control" placeholder="Enter your email" id="email" name="email">
								</div>
                                <div class="error-message text-danger" id="error-email"></div>
							</div>

							<!-- Gender Section -->
							<div class="form-group">
								<label>Gender</label><br>
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="male" name="gender" value="Male">
									<span class="form-check-label"> Male </span>
								</label>
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="female" name="gender" value="Female">
									<span class="form-check-label"> Female</span>
								</label>
							</div>
                            <div class="error-message text-danger" id="error-gender"></div>

							<!-- City and Country Section -->
							<div class="form-row">
								<div class="col form-group">
									<label for="city">City</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-city"></i></span>
										</div>
										<input type="text" class="form-control" placeholder="Enter city" id="city" name="city">
									</div>
                                    <div class="error-message text-danger" id="error-city"></div>
								</div>
								<div class="col form-group">
									<label for="country">Country</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-globe"></i></span>
										</div>
										<select id="country" name="country" class="form-control">
											<option>Choose...</option>
											<option>Uzbekistan</option>
											<option>Russia</option>
											<option>India</option>
											<option>Afghanistan</option>
										</select>
									</div>
                                    <div class="error-message text-danger" id="error-country"></div>
								</div>
							</div>

							<!-- Profile Picture Section -->
                            <div class="form-row">
							<div class="col form-group">
								<label for="profileImg">Profile Picture</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-image"></i></span>
									</div>
									<input type="file" id="profileImg" name="profileImg" accept="image/*" class="form-control">
								</div>
                                <div class="error-message text-danger" id="error-profileImg"></div>
							</div>
                            <div class="col form-group">
								<label for="profileImg">Gallery Picture</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-image"></i></span>
									</div>
									<input type="file" id="image_name" name="image_name[]"  class="form-control" multiple>
								</div>
                                <div class="error-message text-danger" id="error-image_name"></div>
							</div>
                            </div>
							<!-- Password Section -->
							<div class="form-group">
								<label for="password">Create Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-lock"></i></span>
									</div>
									<input type="password" class="form-control" placeholder="Enter your password" id="password" name="password">
								</div>
                                <div class="error-message text-danger" id="error-password"></div>
							</div>

							<!-- Submit Button -->
							<div class="form-group">
								<button type="submit" class="btn w-25 btn-block" style="background: #37486c;color:white">Register</button>
							</div>
						</form>
                        <div id="message"></div>
					</article>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	
	
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
 $(document).ready(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                $('.error-message').html('');
                var formData = new FormData(this);
                $.ajax({
                    url: '/register/create',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.status=='error'){
                  
                      let errors = response.errors;
                          for (let key in errors) {
                              $("#error-" + key).html(errors[key]);
                          }
                         
                     }
                     else
                         {
                            $("#message").html('<p class="text-success">' + response.message + '<a href="/login">login</a>' + '</p>');
                            $("#registrationForm")[0].reset();
                            // window.location.href = '/login';
                        }
                    },
                    error: function() {
                        $("#message").html('<p class="text-danger">An error occurred while submitting the form. Please try again.</p>');
                    }
                });
            });
        });

  
</script>
</html>
