<div id="latest_episodes_list">
	<h4>10 senaste</h4>
	<ul>		
		<?php 
			if(isset($episodes_list)):
				foreach($episodes_list as $episode): ?>
				<li>
					<a href="#" class="episode_title" onclick="ShowEpisode(<?php echo $episode->episodeId ?>)"><?php echo $episode->episodeNr;?>:&nbsp;<?php echo $episode->name;?></a>
					
					<div class="episode_info">
						<?php echo $episode->seriesname; ?><br />
						S&auml;song&nbsp;<?php echo $episode->seasonNr; ?>
					</div>
				</li>
			<?php
				endforeach;
			endif;
			?>
			
	</ul>
</div>