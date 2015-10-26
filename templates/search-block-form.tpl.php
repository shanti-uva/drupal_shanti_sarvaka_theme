<?php

/**
 * @file
 * Displays the search form block.
 *
 * Available variables:
 * - $search_form: The complete search form ready for print.
 * - $search: Associative array of search elements. Can be used to print each
 *   form element separately.
 *
 * Default elements within $search:
 * - $search['search_block_form']: Text input area wrapped in a div.
 * - $search['actions']: Rendered form buttons.
 * - $search['hidden']: Hidden form elements. Used to validate forms when
 *   submitted.
 *
 * Modules can add to the search form, so it is recommended to check for their
 * existence before printing. The default keys will always exist. To check for
 * a module-provided field, use code like this:
 * @code
 *   <?php if (isset($search['extra_field'])): ?>
 *     <div class="extra-field">
 *       <?php print $search['extra_field']; ?>
 *     </div>
 *   <?php endif; ?>
 * @endcode
 *
 * @see template_preprocess_search_block_form()
 */
?>

     <fieldset>

        <div class="search-group">
          <div class="input-group">
				  	<?php print $search['search_block_form']; ?>
				  	<div class="input-group-btn">
				  		<?php print $search['actions']; ?>
				  		<button type="reset" class="btn searchreset"><span class="icon"></span></button>
				  	</div>

				  	<?php print $search['hidden']; ?>

				  </div>

           <!-- search scope -->
           <?php if(isset($search['shanti_options'])): ?>
             <div class="form-group">
             		<?php print render($search['shanti_options']); ?>
                <a href="#" class="advanced-link toggle-link"><span class="icon"></span>Advanced</a>
             </div>
           <?php endif; ?>
				</div>

         <div id="notification-wrapper"></div>

         <section class="advanced-view">
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
				</section>
			</fieldset>