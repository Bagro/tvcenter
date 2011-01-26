<div class="close_btn">x</div>

<div id="episode_popup">
	<table class="editEpisodeTable">
		<tr>
			<td class="label">Avsnitt:</td><td><input id="episodeNr" value="<?php echo $episode->episodeNr; ?>"></td>
		</tr>
		<tr>
			<td class="label">Namn:</td><td><input id="episodeName" value="<?php echo $episode->name; ?>"></td>
		</tr>
		<tr>	
			<td class="label">Beskrivning:</td><td><textarea id="episodeDescription"><?php echo $episode->description; ?></textarea></td>
		</tr>
	</table>
</div>