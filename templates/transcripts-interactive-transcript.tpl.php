<div>
	<div id='<?php print $trid; ?>' class='transcript-player' data-defaultMode='<?php print $default_mode; ?>' data-hello='<?php print $hello; ?>'>
		<table>
			<tr>
				<td class='v-wrap' style='padding-right: 20px;'>
					<?php print $video_tag; ?>
					<?php print render($video_controls); ?>
					<?php print render($hits); ?>
				</td>
				<td class='t-wrap'>
					<?php print render($transcript_controls); ?>
					<?php print render($transcript); ?>
				</td>
			</tr>
		</table>
	</div>
</div>
