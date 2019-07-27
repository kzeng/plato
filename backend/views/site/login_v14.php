<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/animate/animate.css">
	
	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/select2/select2.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/daterangepicker/daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= Url::home(true) . 'login_v14_assets/' ?>css/main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">

				<?php $form = ActiveForm::begin(['id' => 'login-form', 
				'enableClientValidation' => false, 
				'options'=>['class' => 'login100-form validate-form flex-sb flex-w'] ]); ?>

					<span class="login100-form-title p-b-32">
						PLATO
					</span>

					<span class="txt1 p-b-11">
						用户名
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input type="text" id="loginform-username" class="input100" name="LoginForm[username]" placeholder="" aria-required="true">
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						密码
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input type="password" id="loginform-password" class="input100" name="LoginForm[password]" value="" placeholder="" aria-required="true">
						<span class="focus-input100"></span>
					</div>
					
					<input type="hidden" name="LoginForm[rememberMe]" value="0">
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input  type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked class="input-checkbox100">
							<label class="label-checkbox100" for="ckb1">
								记住密码
							</label>
						</div>

						<div>
							<!-- <a href="#" class="txt3">
								Forgot Password?
							</a> -->
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit"  name="login-button" class="login100-form-btn">
							登录
						</button>
					</div>

					<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/animsition/js/animsition.min.js"></script>

	<script src="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?= Url::home(true) . 'login_v14_assets/' ?>vendor/select2/select2.min.js"></script>
<!--
	<script src="<//?= Url::home(true) . 'login_v14_assets/' ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<//?= Url::home(true) . 'login_v14_assets/' ?>vendor/daterangepicker/daterangepicker.js"></script>

	<script src="<//?= Url::home(true) . 'login_v14_assets/' ?>vendor/countdowntime/countdowntime.js"></script>
-->

	<script src="<?= Url::home(true) . 'login_v14_assets/' ?>js/main.js"></script>

</body>
</html>