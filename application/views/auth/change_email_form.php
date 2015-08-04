<?php
$password = array(
	'class' => 'form-control login',
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'required'=>'required'
);
$email = array(
	'class' => 'form-control login',
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'required'=>'required'
);
?>
<div class="fullpage">
<?php echo form_open($this->uri->uri_string()); ?>
<div class="container form login" style="margin-bottom:12px;">
	<div class="title">Change Account Email</div>
	<div class="heading">Password</div>
	<div class="field login">
		<?php echo form_password($password); ?>
	</div>
	<div class="error">
		<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
	</div>

	<div class="heading">New email</div>

	<div class="field login">
		<?php echo form_input($email); ?>
	</div>
	<div class="error">
		<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
	</div>
	<button type="submit" value="Change password" name="change" class="btn btn-filled login">Change Password</button>
	<?php echo form_close(); ?>

</div>

</div>