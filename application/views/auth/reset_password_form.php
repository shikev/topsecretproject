<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'type' => 'password',
	'class' => 'form-control login',
	'onblur' => 'checkEmpty(this);'
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'type' => 'password',
	'class' => 'form-control login',
	'onblur' => 'checkEmpty(this);'
);
?>

<div class="fullpage">
	<?php echo form_open($this->uri->uri_string()); ?>

	<div class="container form login">
		<div class="title">Reset Password</div>

		<div class="heading">New Password</div>
		<div class="input-group field login" id="new_passwordValidGroup">
			<?php echo form_password($new_password); ?>
		</div>
		<div class="error">
			<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
		</div>

		<div class="heading">Confirm New Password</div>
		<div class="input-group field login" id="confirm_new_passwordValidGroup">
			<label class="sr-only" id="<?php echo $confirm_new_password['id']?>" for="confirm_new_password">Confirm New Password</label>
			<?php echo form_password($confirm_new_password); ?>
		</div>
		<div class="error">
			<?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
		</div>

		<button type="submit" value="change" name="change" class="btn btn-primary btn-form login">Change Password</button>
	</div>

	<?php echo form_close(); ?>
</div>
