(function($) {
        Drupal.behaviors.shantiSarvakaModeControls = {
                attach: function(context, settings) {
                        $('.mode-selector', context).once('shanti-sarvaka').each(function() {
				var $modeSelect = $('.mode-select', this);
				$('option[value=transcripts_controller]', $modeSelect).attr('data-icon', 'shanticon-play-transcript');
                                $('option[value=unit_player]', $modeSelect).attr('data-icon', 'shanticon-stack');
                                $('option[value=speech_bubbles]', $modeSelect).attr('data-icon', 'shanticon-community');
			});
		}
	}
})(jQuery);
