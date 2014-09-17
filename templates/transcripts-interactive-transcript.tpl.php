<div>
	<div id='<?php print $trid; ?>' class='transcript-player' data-defaultMode='<?php print $default_mode; ?>' data-hello='<?php print $hello; ?>'>
		<table>
		<!-- <table class='sticky-header' style='position: fixed; top: 0px; left: 25px; visibility: visible; width: 867px;'> -->
			<tr>
				<td class='v-wrap' style='padding-right: 20px;'>
					<?php print $video_tag; ?>
					<?php print $video_controls; ?>
					<?php print $hits; ?>
				</td>
				<td class='t-wrap'>
					<?php print $transcript_controls; ?>
					<?php print $transcript; ?>
				</td>
			</tr>
		</table>
	</div>
</div>
