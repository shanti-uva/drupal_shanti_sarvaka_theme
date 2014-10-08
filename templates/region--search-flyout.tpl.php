<!-- Search Tab -->
<section id="gen-search" class="extruder right" role="search"> 
 <?php 
    if(isset($search_form['#children'])) {
    	//dpm(render($search_form));
      print render($search_form); 
    }
 
		if(count($other_elements) > 0) { 
			 foreach($other_elements as $el) {  print $el['#children']; } 
		}
?>
</section>
<!-- End of Search Tab -->