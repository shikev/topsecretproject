<div class="fullpage">

<?php echo form_open(base_url() . 'pages/usersearch', array('id'=>'form1', 'class'=>'form-horizontal'));?>
        <div class="form-heading" style="center-align"><h2>Users</h2></div>
            <div class="form-group" id="personNameValidGroup">
                <label class="col-sm-2 control-label" for="personName">Search for Professors </label>
                <div class="col-sm-9">
                    <?php echo form_input(array('name'=>'users', 'id'=>'search', 'class'=>'form-control', 'placeholder'=>'Search Faculty', 'required'=>'required')); ?>
                </div>
            </div>
            
        <?php echo form_button( array('name'=>'users_search_submit','type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block', 'content'=>'Search'))?>
<?php echo form_close()?>


<?php if($userArray == null){
	echo "Search people by name";
}
else{
	echo "Search Results:\n";
	} ?>

<?php foreach ($userArray as $user): ?>

<h3><?php echo $user['name']; ?></h3>
<div class="main">
        Email:<?php echo $user['email'] ?> <br>
        Phone Number:<?php echo $user['phonenumber'] ?><br>
        <a href="<?php echo base_url() . "pages/profile/" . $user['username']; ?>">View Profile</a>
</div>

<?php endforeach ?>

</div>