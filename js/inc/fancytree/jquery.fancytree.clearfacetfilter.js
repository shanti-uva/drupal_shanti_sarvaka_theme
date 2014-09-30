/**
 * Extend Fancy Tree
 * 	Adds clearFacetFilter function
 */

;(function($, undefined) {

// Consider to use [strict mode](http://ejohn.org/blog/ecmascript-5-strict-mode-json-and-more/)
"use strict";
	
	$.ui.fancytree._FancytreeClass.prototype.clearFacetFilter = function() {
		var tree = this,
			treeOptions = tree.options;
		// "unwrap" the <mark>ed text
    tree.$div.eq(0).find('span.fancytree-title mark').each(
        function () {
          var parent = $(this).parent();
        	var children = parent.children().remove(); // took out children selector: '.facet-count, .element-invisible'
          parent.text(parent.text());
          parent.append(children);
        }
    );
		if (tree.activeNode) {
        tree.activeNode.setActive(false);
    }
    tree.clearFilter();
    tree.rootNode.visit(function (node) {
    	  $(node.li).find('span.facet-count').text(node.data.count);
        //node.setExpanded(false);
    });
	};
// End of namespace closure
} (jQuery));