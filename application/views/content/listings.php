<div class="fullpage">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category-modal">Filter by Category</button>

<div class="modal fade" id="category-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter by Category</h4>
      </div>
      <div class="modal-body">
        <h4>Select Categories<h4>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" name="filter">Filter</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#type-modal">Filter by Job Type</button>

<div class="modal fade" id="type-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter by Category</h4>
      </div>
      <div class="modal-body">
        <h4>Select Categories<h4>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" name="filter">Filter</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php foreach ($listingArray as $listing_item): ?>

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