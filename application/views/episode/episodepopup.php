<div class="close_btn">x</div>

<div id="episode_popup">
		<img src="<?php echo base_url(); ?>/posters/<?php echo $episode->image; ?>" alt="Series poster" class="poster" /><br/> 
			
		<div id="ptoggleSeen<?php echo $episode->episodeId ?>" onclick="ToggleSeenStatus(<?php echo $episode->episodeId ?>)" class="<?php if(isset($episode->seen)) echo "seenButton"; else echo "unSeenButton"; ?>">S</div>
		<a href="<?php echo base_url(); ?>download/episode/<?php echo $episode->episodeId ?>" class="downloadButton">D</a>
		<h3><?php echo $episode->episodeNr .': '. $episode->name; ?></h3>		
		<p><?php echo $episode->description; ?></p>	
</div>