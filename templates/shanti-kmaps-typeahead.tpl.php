<!--
 Available variables:
   $namespace - used by the javascript to coordinate related filters and typeahead inputs
   $domain - the user-facing domain name, Subjects or Places
-->

<div id="<?php print $namespace; ?>-typeahead-wrapper"
     class="kmap-typeahead-picker">
  <label><span>Search:</span> <?php print rtrim($domain, 's'); ?> Names</label>
  <input id="<?php print $namespace; ?>-search-term"
         class="kmap-search-term form-control form-text" type="text"
         placeholder="Search <?php print $domain; ?>">
  <span class="icon shanticon-magnify"></span>
  <button type="button" class="btn searchreset" aria-label="Clear search text" style="display: none;"><span class="icon"></span></button>
</div>
