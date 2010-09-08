<div id="favorites_list">
	<h4>Favoriter</h4>
    <ul>
        <?php foreach ($series_list as $series): ?>
            <li>
                <div class="seriesUnseenCount"><?php echo $series->numEpisodes; ?></div>
				<img src="<?php echo base_url(); ?>/posters/<?php echo $series->image; ?>" class="poster" />
                <h3><?php echo $series->name; ?></h3>
				
                <ul class="seriesEpisodeList">
                <?php $currentSeason = 0;
                foreach ($series->episodes as $episode):
                    if($currentSeason != $episode->seasonNr):
                        $currentSeason = $episode->seasonNr;?>
                        <li class="seriesEpisodeListSeason">
                            Season <?php echo $currentSeason; ?> :
                        </li>
                    <?php endif; ?>
                    <li>
                    <?php echo $episode->episodeNr . ': '. $episode->name; ?>                        
                        <a href="#" class="downloadButton">D</a>
                        <a href="#" id="toggleSeen<?php echo $episode->episodeId ?>" onclick="ToggleSeenStatus(<?php echo $episode->episodeId ?>)" class="unSeenButton">S</a>
                </li>
                <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
