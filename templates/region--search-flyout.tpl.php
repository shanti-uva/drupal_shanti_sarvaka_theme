<!-- Search Tab -->
  <section id="gen-search" class="extruder right" >
      <div class="text ui-resizable" >               
        <!-- BEGIN input section -->                    
        <section class="input-section" style="display: block;"> 
          <section class="view-section" style="display: block;">             
        <ul class="nav nav-tabs">
          <li class="treeview active"><a href=".treeview" data-toggle="tab" style="display: block;"><i class="icon km-tree"></i>Tree</a></li>
          <li class="listview"><a href=".listview" data-toggle="tab" style="display: block;"><i class="icon km-list"></i>List</a></li>
        </ul>           
        <div class="tab-content">
                          
          <!-- TAB - tree view -->
          <div class="treeview tab-pane active">
            
            <?php print $content; ?> 
        </section>
      </div>
  </section>
<!-- End of Search Tab -->