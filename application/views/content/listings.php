<div class="fullpage">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category-modal">Filter by Category</button>

<div class="modal fade" id="category-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter by Category</h4>
      </div>
      <div class="modal-body category-box">
        <h4>Select Categories<h4>
        <?php echo form_open(base_url() . 'pages/listing_update', array('id'=>'category-filter')); ?>
            <div class="checkbox">
                <?php echo form_checkbox(array('class'=>'form-control','value'=>'', 'name'=>'categoryBio','id'=>'categoryBio'))?>
                Bio
            </div>      
            <div class="checkbox">
                <?php echo form_checkbox(array('class'=>'form-control','value'=>'', 'name'=>'categoryChem','id'=>'categoryChem'))?>
                Chem
            </div>    
            <div class="checkbox">
                <?php echo form_checkbox(array('class'=>'form-control','value'=>'', 'name'=>'categoryPhysics','id'=>'categoryPhys'))?>
                Physics
            </div>
            <div class="checkbox">
                <?php echo form_checkbox(array('class'=>'form-control','value'=>'', 'name'=>'categoryEcon','id'=>'categoryEcon'))?>
                Econ
            </div>   
            <?php echo form_button( array('type'=>'submit', 'id'=>"category_submit" ,'class'=>'btn btn-primary', 'content'=>'Show me my page!'))?>
      </div>
      <?php echo form_close();?>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
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
        <?php echo form_open(base_url() . 'pages/listing_update'); ?>
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'temp','id'=>'temp'))?>
                Bio
            </div>      
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'temp','id'=>'temp'))?>
                Chem
            </div>    
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'temp','id'=>'temp'))?>
                Physics
            </div>
            <div class="checkbox">
                <?php echo form_checkbox(array('value'=>'true', 'name'=>'temp','id'=>'temp'))?>
                Econ
            </div>   
      </div>
      <?php echo form_close();?>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" name="filter">Filter</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="results">
  <?php $this->view('content/listingresults.php');?>
  

</div>

</div>