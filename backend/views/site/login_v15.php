<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>登录</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . '/' ?>vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v15_assets/' ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v15_assets/' ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . '/' ?>vendor/animate/animate.css">

	<!-- 
	<link rel="stylesheet" type="text/css" href="<//?= Url::home(true) . '/' ?>vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<//?= Url::home(true) . '/' ?>vendor/animsition/css/animsition.min.css"> 
	-->

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . '/' ?>vendor/select2/select2.min.css">

	<!-- <link rel="stylesheet" type="text/css" href="<//?= Url::home(true) . '/' ?>vendor/daterangepicker/daterangepicker.css"> -->

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v15_assets/' ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v15_assets/' ?>css/main.css">

</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(<?= Url::home(true) . 'login_v15_assets/' ?>images/bg-01.jpg);">
					<span class="login100-form-title-1">
					<!-- 智慧云图书馆管理服务平台 -->
					PLATO
					</span>
				</div>

				<?php $form = ActiveForm::begin(['id' => 'login-form', 
				'enableClientValidation' => false, 
				'options'=>['class' => 'login100-form validate-form'] ]); ?>
			
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">用户名</span>
						<input type="text" id="loginform-username" class="input100" name="LoginForm[username]" placeholder="" aria-required="true">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">密码</span>
						<input type="password" id="loginform-password" class="input100" name="LoginForm[password]" value="" placeholder="" aria-required="true">
						<span class="focus-input100"></span>
					</div>

					<input type="hidden" name="LoginForm[rememberMe]" value="0">
					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input  type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked class="input-checkbox100">
							<label class="label-checkbox100" for="ckb1">
								记住密码
							</label>
						</div>

						<div>
							<!-- <a href="#" class="txt1">
								Forgot Password?
							</a> -->
						</div>
					</div>
   
					<div class="container-login100-form-btn" >
						<button type="submit"  name="login-button" class="login100-form-btn">
							登录
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
	
<!--
	<script src="<//?= Url::home(true) . '/' ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/animsition/js/animsition.min.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/select2/select2.min.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/daterangepicker/daterangepicker.js"></script>
	<script src="<//?= Url::home(true) . '/' ?>vendor/countdowntime/countdowntime.js"></script>
	<script src="<//?= Url::home(true) . 'login_v15_assets/' ?>js/main.js"></script>
-->

</body>
</html>