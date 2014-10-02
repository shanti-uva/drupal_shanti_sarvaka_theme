<div>
	<div id='<?php print $trid; ?>' class='transcript-player' data-defaultMode='<?php print $default_mode; ?>' data-hello='<?php print $hello; ?>'>
		<table>
			<tr>
				<td class='v-wrap' style='padding-right: 20px;'>
					<?php print $video_tag; ?>
					<?php print render($video_controls); ?>
				</td>
                                <td class='t-wrap'>
                                        <ul class='nav nav-tabs' role='tablist'>
                                                <li class='active'><a href='#transcript' role='tab' data-toggle='tab'>Transcript</a></li>
                                                <li><a href='#hits' role='tab' data-toggle='tab'>Search</a></li>
                                        </ul>
                                        <div class='t-stuff tab-content'>
                                                <div class='tab-pane active' id='transcript'>
                                                        <?php print render($transcript); ?>
                                                </div>
                                                <div class='tab-pane' id='hits'>
                                                        <?php print render($hits); ?>
                                                </div>
                                        </div>
                                </td>
			</tr>
		</table>
	</div>
</div>
