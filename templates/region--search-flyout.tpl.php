<!-- Search Tab -->
<section id="gen-search" class="extruder right" role="search"> 
 <?php 
    if(isset($search_form['#children'])) {
    	//dpm(render($search_form));
      print render($search_form); 
    }
 
		if(count($other_elements) > 0):  
	?>
		  <!-- Begin View Section -->
		  <section class="view-section" style="display: none;">             
		    <ul class="nav nav-tabs">
		      <li class="treeview active"><a href=".treeview" data-toggle="tab" style="display: none;"><i class="icon shanticon-tree"></i>Tree</a></li>
		      <li class="listview"><a href=".listview" data-toggle="tab" style="display: none;"><i class="icon shanticon-list"></i>List</a></li>
		    </ul>           
		    <div class="tab-content">
		                      
		      <!-- TAB - tree view -->
		      <div class="treeview tab-pane active">
		        <?php 
		          foreach($other_elements as $el) {  print $el['#children']; } 
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
 <?php endif; ?>
</section>
<!-- End of Search Tab -->