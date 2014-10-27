<!-- Search Tab -->
<section id="gen-search" class="extruder right" role="search"> 
  <!-- Begin View Section -->
  <section class="view-section" style="display: none;">
    <?php if ($content): ?>
      <?php print $content; ?>
    <?php endif; ?>    
    <ul class="nav nav-tabs">
      <li class="treeview active"><a href=".treeview" data-toggle="tab" style="display: none;"><i class="icon shanticon-tree"></i>Tree</a></li>
      <li class="listview"><a href=".listview" data-toggle="tab" style="display: none;"><i class="icon shanticon-list"></i>List</a></li>
    </ul>           
    <div class="tab-content">                       
      <!-- TAB - tree view -->
      <div class="treeview tab-pane active">
      <?php
        $block = block_load('csc_views', 'custom_taxonomy_flyout_block');
        print render(_block_get_renderable_array( _block_render_blocks(array($block))));
      ?>
      </div>
      <div class="listview tab-pane">   
        <div class="view-wrap" style="height: 494px;"> <!-- view-wrap controls container height -->              
          <div class="table-responsive">
            <table class="table table-condensed table-results">
              <thead>
                <tr>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
                  <!-- TODO: Need to create the list view as well -->
              </tbody>
            </table>                                   
          </div>
        </div>
      </div>
    </div>
  </section> <!-- End View Section -->
</section>
<!-- End of Search Tab -->

