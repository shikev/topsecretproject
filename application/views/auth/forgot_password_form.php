<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control login',
	'onblur' => 'checkEmpty(this);'
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>

<div class="fullpage">
	<?php echo form_open($this->uri->uri_string()); ?>

	<div class="container form login">
		<div class="title">Forgot Password</div>

		<div class="heading"><?php echo $login_label ?></div>
		<div class="field login" id="loginValidGroup">
			<?php echo form_input($login); ?>
		</div>

		<div class="error">
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
		</div>

		<button type="submit" value="Get a new password" name="reset" class="btn btn-primary login">Get new password</button>
	</div>

	<?php echo form_close(); ?>
</div>
