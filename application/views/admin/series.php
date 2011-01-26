
<div id="series_list">
	<h4><?php if(isset($list_title)) echo $list_title;?></h4>
    <ul>
        <?php foreach ($series_list as $series): ?>
            <li>
                <div class="seriesUnseenCount" title="Totalt antal avsnitt">
					<?php echo $series->numEpisodes; ?>
				</div>

				<img src="<?php echo base_url(); ?>/posters/<?php echo $series->image; ?>" class="poster" />
                <h3>
					<?php echo $series->name; ?>
				</h3>
				<div class="seriesToolbar">
					<button id="editSeries<?php echo $series->seriesId; ?>" onclick="EditSeries(<?php echo $series->seriesId; ?>)" class="adminButton">&Auml;ndra</button>
					<button id="newSeason<?php echo $series->seriesId; ?>" onClick="NewSeason(<?php echo $series->seriesId; ?>)" class="adminButton">Ny s&auml;song</button>
					<button id="deleteSeries<?php echo $series->seriesId; ?>" onClick="DeleteSeries(<?php echo $series->seriesId; ?>)" class="adminButton">Ta bort</button>
				</div>
                <ul class="adminSeriesEpisodeList">
                	<?php $currentSeason = 0;
                		foreach ($series->episodes as $episode):
                    		if($currentSeason != $episode->seasonNr):
                        		$currentSeason = $episode->seasonNr;?>
                        			<li class="adminSeriesEpisodeListSeason">
                            				S&auml;song <?php echo $currentSeason; ?> :
											<span class="seriesToolbar">
												<button class="adminButton">&Auml;ndra</button>
												<button class="adminButton">Ta bort</button>
											</span>	
                        			</li>
                    		<?php endif; ?>
                    		<li>	
                    			<span onclick="ShowEpisode(<?php echo $episode->episodeId ?>)" class="episodeTitle">
									<?php echo $episode->episodeNr . ': '. $episode->name; ?> 
								</span>
                    			<button class="adminInvButton">Ta bort</button>
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
