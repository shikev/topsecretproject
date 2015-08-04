

<?php var_dump($listingArray); ?>





  <h3><?php echo $listingArray['name']; ?></h3>
  <div class="main">
          Professor: <a href="<?php echo base_url() . "pages/profile/" . $listingArray['username']; ?>"><?php echo $professorName;?></a> <br>
          Requirements:<?php echo $listingArray['requirements'] ?> <br>
          Description:<?php echo $listingArray['description'] ?><br>
     
          Hours:<?php echo $listingArray['workschedule'] ?><br>
          <a href="<?php echo base_url() . 'listings/inquire/' . $listingArray['id']?>">Ask about this listing</a>
  </div>

 

  <?php if($listingArray == null){
  	echo '<h3>Invalid listing ID!</h3>';
  }