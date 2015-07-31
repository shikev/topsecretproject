<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>

<div class="fullpage">
	<?php echo form_open($this->uri->uri_string()); ?>

	<div class="container form login">
		<div class="title">Login</div>

		<div class="heading">Username or Email</div>
		<div class="input-group field login" id="loginValidGroup">
			<input class="form-control" name="login" id="login" value="" maxlength="80" onblur="checkEmpty(this);">
		</div>
		<div class="error">
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
		</div>

		<div class="heading">Password</div>
		<div class="input-group field" id="passwordValidGroup">
			<input class="form-control" type="password" name="password" id="password" value="" onblur="checkEmpty(this);">
		</div>
		<div class="error">
			<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
		</div>

        <div class="heading">Remember Me</div>
		<div class="input-group field" id="rememberValidGroup">
			<input type="checkbox" name="remember" id="remember" value="1">
		</div>

		<button type="submit" value="Login" class="btn btn-filled btn-form login">Login</button>
		
		<div>
            <div style="width:50%;float:left;text-align:left;"><a href="<?php echo base_url()?>auth/register">Sign Up</a></div>
            <div style="width:50%;float:right;text-align:right;"><a href="<?php echo base_url()?>auth/forgot_password">Forgot Password</a></div>
            
<!--			&nbsp; &nbsp;-->
		</div>

	</div>
	<?php echo form_close(); ?>
</div>
