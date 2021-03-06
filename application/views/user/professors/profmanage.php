<div class="container body-container form-container fullpage">
        <?php echo form_open($this->uri->uri_string(), array('id'=>'form1', 'class'=>'form-horizontal'));?>
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
                <li><a href="#information" role="tab" data-toggle="tab">Info</a></li>
                <li><a href="#connections" role="tab" data-toggle="tab">Connections</a></li>
                <li><a href="#requests" role="tab" data-toggle="tab">Requests</a></li>
                <li><a href="#account" role="tab" data-toggle="tab">Account</a></li>


            </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="profile">
        <?php echo form_open($this->uri->uri_string(), array('id'=>'form1', 'class'=>'form-horizontal'));?>
        <div class="form-heading"><h2>User profile</h2></div>
        <div class="form-heading"><h5>Manage your profile</h5></div>
            <div class="form-group" id="personNameValidGroup">
                <label class="col-sm-2 control-label" for="personName">Name: </label>
                <div class="col-sm-9">
                    <?php echo form_error('personName'); ?>
                    <?php echo form_input(array('value'=>$name, 'name'=>'personName', 'id'=>'personName', 'class'=>'form-control', 'onblur'=>'checkEmpty(this);', 'placeholder'=>'Your name', 'required'=>'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">Email Address: </label>
                <div class="col-sm-9">
                    <?php echo form_error('email'); ?>
                    <?php echo form_input(array('value'=>$email, 'name'=>'email','id'=>'email' ,'class'=>'form-control', 'placeholder'=>'Where you want people to contact you (could be different from login email)'))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="phonenumber">Phone Number: </label>
                <div class="col-sm-9">
                    <?php echo form_error('phonenumber'); ?>
                    <?php echo form_input(array('value'=>$phonenumber, 'name'=>'phonenumber','id'=>'phonenumber' ,'class'=>'form-control', 'placeholder'=>'https://www.linkedin.com/yourprofile'))?>
                </div>
            </div>
            
                <?php echo form_button( array('name'=>'profile_submit','type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block', 'onclick'=>'validate();', 'content'=>'Save'))?>
                <?php echo form_close()?>

            <hr />

            
        </div>


        <div class="tab-pane" id="information">
            <?php echo form_open($this->uri->uri_string(), array('id'=>'form1', 'class'=>'form-horizontal'));?>
            <div class="form-heading"><h2>User Information</h2></div>
            <div class="form-heading"><h5>These will be public to those who view your profile</h5></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="hook">Department: </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('value'=>$department, 'name'=>'department','id'=>'department' ,'class'=>'form-control', 'placeholder'=>'Computer Science'))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="bio">Bio</label>
                <div class="col-sm-9">
                    <?php echo form_textarea(array('value'=>$bio, 'name'=>'bio','id'=>'bio' ,'class'=>'form-control', 'placeholder'=>'A short description of who you are.'))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="interests">Interests</label>
                <div class="col-sm-9">
                    <?php echo form_textarea(array('value'=>$interests, 'name'=>'interests','id'=>'interests' ,'class'=>'form-control', 'placeholder'=>'Some of your interests'))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="additionalinfo">Additional Info</label>
                <div class="col-sm-9">
                    <?php echo form_textarea(array('value'=>$additionalinfo, 'name'=>'additionalinfo','id'=>'additionalinfo' ,'class'=>'form-control', 'placeholder'=>'Extra info you would like others to see'))?>
                </div>
            </div>
            <?php echo form_button( array('name'=>'info_submit','type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block', 'onclick'=>'validate();', 'content'=>'Save'))?>
            <?php echo form_close()?>


        </div>

        <div class="tab-pane" id="connections">
            <div class="form-heading"><h2>Connections</h2></div>
            <div class="form-heading"><h5>Manage your connections<?php echo $this->tank_auth->get_username(); ?></h5></div>

                <?php foreach($connectionsArray as $connection){ 
                    echo $connection['sourcename']; echo '<br>';
                    
                }?>


        </div>

        <div class="tab-pane" id="requests">
            <div class="form-heading"><h2>Requests</h2></div>
            <div class="form-heading"><h5>Manage your requests</h5></div>
                <?php var_dump($requestsArray);?>
                <?php if($requestsArray != null){
                    foreach($requestsArray as $request){ 
                        if($request['type'] == 'endorsement'){
                            echo $request['source'] . "would an endorsement from you<br>";
                            echo "Message:" . $request['message'] . "<br>";
                            echo '<button class="btn">Approve</button><br>';
                        }
                        else if($request['type'] == 'recletter'){
                            echo $request['source'] . " would like you to write a letter of recommendation for them.<br>";
                            echo "Message:" . $request['message'] . "<br>";
                            echo '<button class="btn">Answer</button><br>';
                        }
                    }
                }?>


        </div>

        <div class="tab-pane" id="account">
            <div class="form-heading"><h2>Account Management</h2></div>
            <div class="form-heading"><h5>Account username: <?php echo $this->tank_auth->get_username(); ?></h5></div>

                <a class="btn btn-default" href="<?php echo base_url();?>auth/change_password">Change Password</a>

                <a class="btn btn-default" href="<?php echo base_url();?>auth/change_email">Change Email</a>


        </div>



        </div>
    </div>

</div>

