<div class="close_btn">x</div>
<div id="episode_popup">
	
		<img src="<?php echo base_url(); ?>/posters/<?php echo $episode->image; ?>" alt="Series poster" class="poster" />
		<h3><?php echo $episode->episodeNr .': '. $episode->name; ?></h3>
		<p><?php echo $episode->description; ?></p>
</div>