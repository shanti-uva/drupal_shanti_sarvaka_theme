<!-- Search Tab -->
<section id="gen-search" class="extruder right" role="search">
  <!-- BEGIN Input Section -->                 
  <section class="input-section">                   
    <form class="form">
     <fieldset>                       
        <div class="search-group">                        
            <div class="input-group">
                <input type="text" class="form-control kms" id="searchform" placeholder="Enter Search...">
                <span class="input-group-btns">
                  <button type="button" class="btn btn-default" id="searchbutton"><i class="icon"></i></button>
                  <button type="reset" class="searchreset">&times;</button>
                </span>
            </div>
            
           <!-- search scope -->
           <div class="form-group">
             <label class="radio-inline" for="descscope"><input type="radio" id="descscope" name="srchscope" value="descriptions" data-value="descriptions" checked="checked">Descriptions</label>
             <label class="radio-inline" for="transscope"><input type="radio" id="transscope" name="srchscope" value="transcripts" data-value="transcripts">Transcripts</label>                      
           </div>
           
       </div><!-- END search group -->
     </fieldset>
     
   </form>
  </section>  <!-- End Input Section -->
  
  <!-- Begin View Section -->
  <section class="view-section" style="display: block;">             
    <ul class="nav nav-tabs">
      <li class="treeview active"><a href=".treeview" data-toggle="tab" style="display: block;"><i class="icon km-tree"></i>Tree</a></li>
      <li class="listview"><a href=".listview" data-toggle="tab" style="display: block;"><i class="icon km-list"></i>List</a></li>
    </ul>           
    <div class="tab-content">
                      
      <!-- TAB - tree view -->
      <div class="treeview tab-pane active">
        <?php print $content; ?> 
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
              <tbody></tbody>
             </table>                                   
          </div>
        </div>
      </div>
    </div>
  </section> <!-- End View Section -->
  
</section>
<!-- End of Search Tab -->