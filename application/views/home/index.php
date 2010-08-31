<div id="favorites_list">
    <ul>
        <?php foreach ($series_list as $series): ?>
            <li>
                <div class="seriesUnseenCount"><?php echo $series->numEpisodes; ?></div>
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
                </li>
                <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</div>