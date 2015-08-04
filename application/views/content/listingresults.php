

<?php if($listingArray != null) foreach ($listingArray as $listing_item): ?>

<?php if(gettype($listing_item) == 'object') $listing_item = get_object_vars($listing_item);?>

  <h3><a href="<?php echo base_url() . 'listings/view/' . $listing_item['id']?>"><?php echo $listing_item['name']; ?></a></h3>
  <div class="main">
          Requirements:<?php echo $listing_item['requirements'] ?> <br>
          Description:<?php echo $listing_item['description'] ?><br>
          Hours:<?php echo $listing_item['workschedule'] ?><br>
  </div>

  <?php endforeach ?>

  <?php if($listingArray == null){
  	echo '<h3>No results found</h3>';
  }