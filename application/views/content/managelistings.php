<?php 
if($listingArray != null) foreach ($listingArray as $listing_item): ?>


  <h3><a href="<?php echo base_url() . 'manage/editlisting/' . $listing_item['id']?>">Edit Listing: <?php echo $listing_item['name']; ?></a></h3>
  <div class="main">
          Requirements:<?php echo $listing_item['requirements'] ?> <br>
          Description:<?php echo $listing_item['description'] ?><br>
          Compensation:<?php echo $listing_item['pay'] ?><br>
          Hours:<?php echo $listing_item['workschedule'] ?><br>
  </div>

  <?php endforeach ?>

  <?php if($listingArray == null){
  	echo '<h3>You have no listings! <a href="' . base_url() . 'manage/createlisting' . '">Create one here!</a></h3>';
  }