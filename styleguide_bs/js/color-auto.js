$(document).ready(function() {
	$('.sg-color > .sg-color-auto').each(function() {
		var me = $(this);
		var ccode = me.children('span').text();
		me.css("backgroundColor", ccode);
	});
});
