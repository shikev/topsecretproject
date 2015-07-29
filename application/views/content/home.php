<div class="container form-container">

        <?php echo form_open(base_url() . 'pages/listings', array('id'=>'form1', 'class'=>'form-horizontal'));?>
        <div class="form-heading" style="center-align"><h2>Listings</h2></div>
            <div class="form-group" id="personNameValidGroup">
                <label class="col-sm-2 control-label" for="personName">Search </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('name'=>'listings', 'id'=>'search', 'class'=>'form-control', 'placeholder'=>'Search Listings', 'required'=>'required')); ?>
                </div>
            </div>
            
                <?php echo form_button( array('name'=>'listing_search_submit','type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block', 'content'=>'Search'))?>
        <?php echo form_close()?>

        <a class="btn btn-default" href="<?php echo base_url();?>pages/listings">View All Listings</a>

        <?php echo form_open(base_url() . 'pages/listings', array('id'=>'form1', 'class'=>'form-horizontal'));?>
        <div class="form-heading" style="center-align"><h2>Users</h2></div>
            <div class="form-group" id="personNameValidGroup">
                <label class="col-sm-2 control-label" for="personName">Search by users </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('name'=>'users', 'id'=>'search', 'class'=>'form-control', 'placeholder'=>'Search Listings', 'required'=>'required')); ?>
                </div>
            </div>
            
                <?php echo form_button( array('name'=>'users_search_submit','type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block', 'content'=>'Search'))?>
        <?php echo form_close()?>



    </div>

</div>

