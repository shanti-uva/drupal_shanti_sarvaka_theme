<?php 
 /**
  * Template for the Language Chooser Drop down in the top bar of the Sarvaka theme
  * Uses varuabkes from shanti_sarvaka_preprocess_block() in template.php
  * 		$language = currently chosen language interface
  * 		$languages = array of all enabled languages
  * 	
  * 		plus regular block variables
 	*/
 ?>
<li class="dropdown lang highlight" id="block-locale-language">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php print $language->native; ?></span><i 
		class="icon shanticon-arrowselect"></i></a><ul class="dropdown-menu">
		<?php foreach($languages as $n => $lang): ?>
			<li class="form-group"><label class="radio-inline" for="optionlang<?php print ($n + 1); ?>">
				<input type="radio" name="radios" id="optionlang<?php print ($n + 1); ?>" class="optionlang" 
						value="lang:<?php print $lang->prefix; ?>" 
						<?php if($lang->language == $language->language) { print ' checked="checked"'; }?> ><?php print $lang->native; ?></label></li>
		<?php endforeach; ?>
	</ul>
</li>
	