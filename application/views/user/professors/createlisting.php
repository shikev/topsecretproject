<div class="container body-container form-container">
    <?php echo form_open($this->uri->uri_string(), array('id'=>'form1', 'class'=>'form-horizontal'));?>
        <div class="form-heading"><h2>Create a Listing</h2></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="personName">Listing Title: </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('value'=>'', 'name'=>'listingName', 'id'=>'listingName', 'class'=>'form-control', 'onblur'=>'checkEmpty(this);', 'placeholder'=>'Listing Name', 'required'=>'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">Requirements: </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('value'=>'', 'name'=>'requirements','id'=>'requirements' ,'class'=>'form-control', 'placeholder'=>'Prior Chemistry Lab Experience'))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="linkedin">Description: </label>
                <div class="col-sm-9">
                    <?php echo form_textarea(array('value'=>'', 'name'=>'description','id'=>'description' ,'class'=>'form-control', 'placeholder'=>'This project is dedicated to figuring out what happens when you mix chemicals', 'required'=>'required'))?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="description">Work Schedule: </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('value'=>'', 'name'=>'time','id'=>'time' ,'class'=>'form-control', 'placeholder'=>'5 to 7 on Mondays, Wednesdays, and Fridays', 'required'=>'required'))?>
                </div>
            </div>
            <h4>Select Departments<h4>
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'categoryBio','id'=>'categoryBio'))?>
                Bio
            </div>      
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'categoryChem','id'=>'categoryChem'))?>
                Chem
            </div>    
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'categoryPhysics','id'=>'categoryPhys'))?>
                Physics
            </div>
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'categoryEcon','id'=>'categoryPhys'))?>
                Physics
            </div>   


</div>

    <?php echo form_button( array('type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block', 'content'=>'Create', 'required'=>'required'))?>
    <?php echo form_close()?>
</div>

