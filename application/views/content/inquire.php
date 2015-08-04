<?php $message = array(
  'class' => 'form-control',
  'name'  => 'message',
  'id'  => 'message',
  'rows' => 2,
  'required'=>'required'
); ?>


  <h3><?php echo $listingArray['name']; ?></h3>
  <div class="main">
          Professor: <a href="<?php echo base_url() . "pages/profile/" . $listingArray['username']; ?>"><?php echo $professorName;?></a> <br>
          Requirements:<?php echo $listingArray['requirements'] ?> <br>
          Description:<?php echo $listingArray['description'] ?><br>
         
          Hours:<?php echo $listingArray['workschedule'] ?><br>

  </div>

<form action="<?php echo $this->uri->uri_string();?>">
<label class="col-sm-2 control-label" for="message">Ask <?php echo $professorName;?> About This Listing</label>
<?php echo form_textarea($message)?>
<?php echo form_button( array('name'=>'message_submit','type'=>'submit', 'id'=>"btnSubmit" ,'class'=>'btn btn-default maroon center-block','content'=>'Send'))?>
</form>
 

  <?php if($listingArray == null){
  	echo '<h3>Invalid listing ID!</h3>';
  }