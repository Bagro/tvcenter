<div class="close_btn">x</div>

<div id="episode_popup">
		<img src="<?php echo base_url(); ?>/posters/<?php echo $episode->image; ?>" alt="Series poster" class="poster" /><br/> 
			
		<div id="ptoggleSeen<?php echo $episode->episodeId ?>" onclick="ToggleSeenStatus(<?php echo $episode->episodeId ?>)" class="<?php if(isset($episode->seen)) echo "seenButton"; else echo "unSeenButton"; ?>" title="Markera som sett">S</div>
		<a href="<?php echo base_url(); ?>download/episode/<?php echo $episode->episodeId ?>" class="<?php if(isset($episode->download)) echo "downloadedButton"; else echo "downloadButton"; ?>" title="Ladda ner">D</a>
		<a href="<?php echo base_url(); ?>download/stream/<?php echo $episode->episodeId .'_'. current_sessionId() .'_'. current_userid() ?>" class="streamButton" title="Streaming, kopiera länken till VLC eller liknande..">V</a>
		<h3><?php echo $episode->episodeNr .': '. $episode->name; ?></h3>		
		<p><?php echo $episode->description; ?></p>	
</div>