<?php foreach ($listingArray as $listing_item): ?>

<?php if(gettype($listing_item) == 'object') $listing_item = get_object_vars($listing_item);?>

  <h3><?php echo $listing_item['name']; ?></h3>
  <div class="main">
          Requirements:<?php echo $listing_item['requirements'] ?> <br>
          Description:<?php echo $listing_item['description'] ?><br>
          Compensation:<?php echo $listing_item['pay'] ?><br>
          Hours:<?php echo $listing_item['workschedule'] ?><br>
  </div>

  <?php endforeach ?>