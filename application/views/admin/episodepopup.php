<div class="close_btn">x</div>

<div id="episode_popup">
		<img src="<?php echo base_url(); ?>/posters/<?php echo $episode->image; ?>" alt="Series poster" class="poster" /><br/> 
			
		<div class="episodeToolbar"> 
			<button class="adminButton" onClick="$('#popup_window').load('<?php echo base_url(); ?>/adminepisode/edit/<?php echo $episode->episodeId; ?>');">&Auml;ndra</button>
			<button class="adminButton">Byt bild</button>
			<button class="adminButton">Ladda ner data</button>
		</div>
		
		<h3><?php echo $episode->episodeNr .': '. $episode->name; ?></h3>		
		<p><?php echo $episode->description; ?></p>	
</div>