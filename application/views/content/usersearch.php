<div class="fullpage">

<?php foreach ($userArray as $user): ?>

<h3><?php echo $listing_item['name']; ?></h3>
<div class="main">
        Requirements:<?php echo $listing_item['requirements'] ?> <br>
        Description:<?php echo $listing_item['description'] ?><br>
        Compensation:<?php echo $listing_item['pay'] ?><br>
        Hours:<?php echo $listing_item['workschedule'] ?><br>
        School:<?php echo $schoolName?>
</div>

<?php endforeach ?>

</div>