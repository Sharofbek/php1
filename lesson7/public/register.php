<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/src/helpers.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/db.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
	if(isLoggedIn()){
		if(isAdmin($_COOKIE['user_id'])){
			header('Location: '.env('APP_URL')."admin");
		}else{
			header('Location: '.env('APP_URL')."public");
		}
		exit();
	}elseif(isset($_POST)){
		if(isset($_POST['login']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
			$error = [];
			if(strlen($_POST['password'])<6 || strlen($_POST['password'])>16){
				$error['password'] = "The length of password must be maximum 16 and minimum 6 characters";
			}else if ($_POST['password'] !== $_POST['confirmPassword']){
				$error['confirmPassword'] = "Password confirmation failed!";
			}else if (!(preg_match("#^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$#", $_POST['email']) && isset($_POST['email']))){
				$error['email'] = 'Please enter valid email address!';
			}else {
				$login = $_POST['login'];
				$password = $_POST['password'];
				$salt = env('PASSWORD_SALT');
				$pass = $salt.md5($password.$salt);
				if($stmt = mysqli_prepare($conn, 'SELECT id FROM users WHERE login = ? OR email = ?')){
					mysqli_stmt_bind_param($stmt, "ss", $login, $_POST['email']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $id);
					mysqli_stmt_fetch($stmt);
					mysqli_stmt_close($stmt);
					if(!(is_null($id))){
						$error['main'] = "Login or email already taken by another user!";
					}else {
						if($stmt = mysqli_prepare($conn, 'INSERT INTO users (name, login, email, password) VALUES (?, ?, ?, ?)')){
							$res = mysqli_stmt_bind_param($stmt, "ssss", $_POST['name'], $login, $_POST['email'], $pass);
							if(mysqli_stmt_execute($stmt)){
								$_SESSION['is_logged'] = true;
								$id = mysqli_stmt_insert_id($stmt);
								if(isset($_POST['keep_logged'])){
									setcookie('user_id', $id, time()+60*60*24*30);
									$_SESSION['is_admin'] = false;
								}
								$_SESSION['user_id'] = $id;
							}else {
								$error['main'] = "Something went wrong try again please!";
							}
							header('Location: '.env('APP_URL').'public');
						}
						$error['main'] = "Login or email already taken by another user!";
					}
				}else {
					$error['main'] = "Something went wrong try again please!";
				}
			}
		}
	}
	require_once $_SERVER['DOCUMENT_ROOT']."public/header.php";
?>

  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="login.html">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<?= printIfError('main')?>
						<form class="row login_form" action="register.php" id="register_form" method="POST">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Login'" required="" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''?>">
								<?= printIfError('name')?>
								
							</div>							
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="login" placeholder="Login" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Login'" required="" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''?>">
								<?= printIfError('login')?>
							</div>							
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required="" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''?>"> 
								<?= printIfError('email')?>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required="">
							</div>
							<?= printIfError('password')?>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
								<?= printIfError('confirmPassword') ?>
							</div>
							<?= printIfError('password')?>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="keep_logged">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-register w-100">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'public/footer.php'
?>