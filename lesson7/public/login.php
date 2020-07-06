<?php
require_once $_SERVER['DOCUMENT_ROOT']."/src/helpers.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/db.php";
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if(isset($_GET['logout'])){
		if(intval($_GET['logout'])==1){
			if (isset($_COOKIE['user_id'])) {
			    setcookie('user_id', null, -1,'/');
			}
			$_SESSION = [];
			$_COOKIE = [];
			header("Location: ".env("APP_URL").'public');
			exit();
		}
	}
	if(isLoggedIn()){
		if(isAdmin($_COOKIE['user_id'])){
			header('Location: '.env('APP_URL')."admin");
		}else{
			header('Location: '.env('APP_URL')."public");
		}
		exit();
	}else if(isset($_POST)){
		if(isset($_POST['login']) && isset($_POST['password'])){
			$error = false;
			$login = $_POST['login'];
			$password = $_POST['password'];
			$salt = env('PASSWORD_SALT');
			$pass = $salt.md5($password.$salt);
			if($stmt = mysqli_prepare($conn, 'SELECT id, name, is_admin FROM users WHERE login = ? AND password = ?')){
				mysqli_stmt_bind_param($stmt, "ss", $login, $pass);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $id, $name, $is_admin);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);
				if(!(is_null($id) || is_null($name) || is_null($is_admin))){
					$_SESSION['is_logged'] = true;
					if(isset($_POST['keep_logged'])){
						echo "Keeping Logged";
						setcookie('user_id', $id, time()+60*60*24*30,'/');
					}
					$_SESSION['user_id'] = $id;
					if($is_admin){
						$_SESSION['is_admin'] = true;
						header('Location: '.env('APP_URL').'admin');
					}else {
						header('Location: '.env('APP_URL').'public');
					}
					exit();
				}else {
					$error['main'] = "Login or Password incorrect !";
				}
			}else {
				$error['main'] = "Something went wrong try again please!";
			}
		}
	}else{
		$_COOKIE = [];
		$error['main'] = "Something went wrong. Try again please !";
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
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="register.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<?= printIfError('main')?>
						<h3>Log in to enter</h3>
						<form class="row login_form" action="login.php" id="contactForm" method="POST">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="login" placeholder="Login" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Login'" value="<?= $_POST['login'] ?? '' ?>">
								<?= printIfError('login')?>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="name" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
								<?= printIfError('password')?>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="keep_logged">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Log In</button>
								<a href="#">Forgot Password?</a>
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