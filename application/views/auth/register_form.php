<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class' => 'form-control login',
		'onblur' => 'checkEmpty(this);'
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control login',
	'onblur' => 'checkEmpty(this);'
);
$password = array(
	'type' => 'password',
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control login',
	'onblur' => 'checkEmpty(this);'
);
$confirm_password = array(
	'type' => 'password',
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control login',
	'onblur' => 'checkEmpty(this);'
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
		<div class="title">Sign Up</div>

		<?php if($use_username) { ?>
			<div class="heading" id="username">Username</div>
			<div class="input-group field login" id="usernameValidGroup">
				<?php echo form_input($username); ?>
			</div>
			<div class="error">
				<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
			</div>
		<?php } ?>

		<div class="heading" id="email">Email Address</div>
		<div class="input-group field login" id="emailValidGroup">
			<?php echo form_input($email); ?>
		</div>
		<div class="error">
			<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
		</div>

		<div class="heading" id="password">Password</div>
		<div class="input-group field login" id="passwordValidGroup">
			<?php echo form_input($password); ?>
		</div>
		<div class="error">
			<?php echo form_error($password['name']); ?>
		</div>

		<div class="heading" id="confirm_password">Confirm Password</div>
		<div class="input-group field login" id="confirm_passwordValidGroup">
			<?php echo form_input($confirm_password); ?>
		</div>
		<div class="error">
			<?php echo form_error($confirm_password['name']); ?>
		</div>

		<button type="submit" value="register" name="register" class="btn btn-filled btn-form login">Sign Up</button>
	</div>

	<?php echo form_close(); ?>
</div>
