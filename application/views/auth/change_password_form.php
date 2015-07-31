<?php
$old_password = array(
	'class' => 'form-control login',
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
	'onblur' => 'checkEmpty(this);'
);
$new_password = array(
	'class' => 'form-control login',
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'onblur' => 'checkEmpty(this);'
);
$confirm_new_password = array(
	'class' => 'form-control login',
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'onblur' => 'checkEmpty(this);'
);
?>

<div class="fullpage">
	<?php echo form_open($this->uri->uri_string()); ?>

        <div class="container form login" style="margin-bottom:12px;">
            <div class="title">Change Password</div>

            <div class="heading">Old Password</div>
            <div class="field login" id="old_passwordValidGroup">
                <?php echo form_password($old_password); ?>
            </div>
            <div class="error">
                <?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?>
            </div>

            <div class="heading">New Password</div>
            <div class="field login" id="new_passwordValidGroup">
                <?php echo form_password($new_password); ?>
            </div>
            <div class="error">
                <?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
            </div>

            <div class="heading">Confirm New Password</div>
            <div class="field login" id="confirm_new_passwordValidGroup">
                <?php echo form_password($confirm_new_password); ?>
            </div>
            <div class="error">
                <?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
            </div>

            <button type="submit" value="Change password" name="change" class="btn btn-filled login">Change Password</button>
        </div>

    <?php echo form_close(); ?>
</div>

