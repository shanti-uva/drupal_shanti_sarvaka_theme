(function($) {
        Drupal.behaviors.shantiSarvakaViewerControls = {
        attach: function(context, settings) {
        $('.viewer-selector', context).once('shanti-sarvaka').each(function() {
				
				var $viewerSelect = $('.viewer-select', this);
				$('option[value=transcripts_controller]', $viewerSelect).attr('data-icon', 'shanticon-play-transcript');
        $('option[value=unit_player]', $viewerSelect).attr('data-icon', 'shanticon-stack');
        $('option[value=speech_bubbles]', $viewerSelect).attr('data-icon', 'fa-comments-o');
			});
		}
	}
})(jQuery);
