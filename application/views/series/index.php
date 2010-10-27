
<div id="series_list">
	<h4><?php if(isset($list_title)) echo $list_title;?></h4>
    <ul>
        <?php foreach ($series_list as $series): ?>
            <li>
                <div class="seriesUnseenCount" title="Totalt antal avsnitt">
					<?php echo $series->numEpisodes; ?>
				</div>
				<div id="togglefavorite<?php echo $series->seriesId; ?>" onclick="ToggleFavorite(<?php echo $series->seriesId; ?>)" class="<?php if(isset($series->favorite)) echo 'favoriteButton'; else echo 'notFavoriteButton'; ?>" title="Markera serie som favorit">F</div>
					
				<img src="<?php echo base_url(); ?>/posters/<?php echo $series->image; ?>" class="poster" />
                <h3>
					<?php echo $series->name; ?>
				</h3>
				
                <ul class="seriesEpisodeList">
                	<?php $currentSeason = 0;
                		foreach ($series->episodes as $episode):
                    		if($currentSeason != $episode->seasonNr):
                        		$currentSeason = $episode->seasonNr;?>
                        			<li class="seriesEpisodeListSeason">
                            				S&auml;song <?php echo $currentSeason; ?> :
                        			</li>
                    		<?php endif; ?>
                    		<li>	
                    			<span onclick="ShowEpisode(<?php echo $episode->episodeId ?>)" class="episodeTitle">
									<?php echo $episode->episodeNr . ': '. $episode->name; ?> 
								</span>
                    			<a href="<?php echo base_url(); ?>download/episode/<?php echo $episode->episodeId ?>" class="downloadButton" title="Ladda ner">D</a>
                    			<div id="toggleSeen<?php echo $episode->episodeId ?>" onclick="ToggleSeenStatus(<?php echo $episode->episodeId ?>)" class="<?php if(isset($episode->seen)) echo "seenButton"; else echo "unSeenButton"; ?>" title="Markera som sett">S</div>
                			</li>
                		<?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
	<div id="paging">
		<?php
		 	if(isset($pagenation))
				echo $pagenation;
		?>
	</div>
</div>
