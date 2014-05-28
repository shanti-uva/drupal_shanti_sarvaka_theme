<!-- Search Tab -->
<section id="gen-search" class="extruder right" >
  <!-- BEGIN Input Section -->                 
  <section class="input-section">                   
    <form role="form" class="form">
     <fieldset>                       
      <legend class="hidden">Search Form</legend>                 
                                
        <div class="input-group">
            <input id="searchform" class="form-control kms" type="text" placeholder="Enter Search...">
            <span class="input-group-btn">
              <button type="reset" class="searchreset">&times;</button>
              <button id="searchbutton" type="button" class="btn btn-default"><i class="icon"></i></button>
            </span>
        </div>

       <!-- search scope -->
       <div class="btn-group" data-toggle="buttons">
           <label class="checkbox-inline">
               <input type="checkbox" id="termscope" name="term-scope" checked="checked" data-value="terms"> Titles
           </label>
           <label class="checkbox-inline">
               <input type="checkbox" id="summaryscope" name="summary-scope" checked="checked" data-value="summaries"> Descriptions
           </label>
           <label class="checkbox-inline" >
               <input type="checkbox" id="essayscope" name="essay-scope" data-value="essays"> Other
           </label>
        </div>

        <a href="#" class="advanced-link toggle-link"><i class="icon"></i>Advanced</a>  
        <div id="notification-wrapper"></div>
        
       <!-- advanced search hidden content -->
       <div class="advanced-view" style="display:none;">
        
                                      
          <div class="form-group"> 
            <label class="radio-inline" for="radios-0">
              <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
                All Text</label> 
            <label class="radio-inline" for="radios-1">
              <input type="radio" name="radios" id="radios-1" value="2">
                Name </label> 
          </div>
                                      
          <div class="form-group">
            <label class="radio-inline" for="radios-2">
              <input type="radio" name="radios2" id="radios-2" value="3" checked="checked">
                Contains</label> 
            <label class="radio-inline" for="radios-3">
              <input type="radio" name="radios2" id="radios-3" value="4">
                Starts With</label>
            <label class="radio-inline" for="radios-4">
              <input type="radio" name="radios2" id="radios-4" value="5">
                Exactly</label>                             
          </div>
          
          <div class="form-group">
            <label class="checkbox-inline" for="checkbox-1">
              <input type="checkbox" name="checkbox" id="checkbox-1" value="6">
                Show only entries with essays</label> 
          </div>

          <div class="form-group">                                    
            <label class="checkbox-inline" for="checkbox-2">
              <input type="checkbox" name="checkbox" id="checkbox-2" value="7" checked="checked">
                Show feature details</label>                              
          </div>
          
          
          
          
          <!-- feature tree, under contruction -->
          <div class="form-group km-input feature-group dropdown">
                <a href="#" class="feature-toggle toggle-link" data-toggle="dropdown"><i class="icon"></i>Show Features</a>     
                <span class="filter"><label>Filter:</label> <span id="matches"></span></span>                       

                
                <input class="form-control feature-name" id="feature-name" name="features" type="text" placeholder="Filter by Feature Name">  
                                      
                <div class="dropdown-menu feature-menu">
                    <div class="tree-wrap"> 

                      <div class="feature-container">                             
                        <div id="feature-tree"></div> <!-- features tree, under construction -->                              
                      </div> 
                                                  
                      <div class="feature-submit">
                        <button type="button" class="btn btn-default">Select</button>
                        <button id="btnResetSearch" class="btn btn-default clear-form">Cancel <span>&times;</span></button>
                      </div>
                                                  
                    </div>                      
                </div> <!-- END dropdown-menu -->
                
                <button id="feature-reset" class="feature-reset">&times;</button>
          </div> <!-- END feature-group -->
          
          
          
          
          <div class="form-group km-input">                                   
              <input class="form-control kms-fsid" id="feature-id" type="text" placeholder="Filter by Feature ID">
          </div>               
          
          <div class="form-group"> 
                <select class="selectpicker" id="selector1" name="selector1" multiple data-selected-text-format="count" data-header="Select from the following..." data-width="100%">
                  <option>Selector One</option>
                  <option>Selector</option>
                  <option>Selector</option>
                  <option>Selector Text</option>
                  <option>Selector Text Text</option>
                  <option>Selector Very Long Text</option>
                  <option>Selector Very Long Long Text</option>
                  <option>Shorter</option>
                  <option>Shorter</option>
                  <option>Shorter Text</option>
                  <option>Shorter Text Text</option>
                </select>
          </div>

       </div>
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
  
<!-- End of Search Tab -->