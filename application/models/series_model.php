<?php

class Series_model extends Model {

    function list_series($page, $max_per_page) {
        $this->db->orderby('name');
        $query = $this->db->get('series', $max_per_page, $max_per_page * $page);
        return $query->result();
    }

    function list_favorite_series_with_unseen_episodes($userId) {
        $queryStr = "SELECT s.* FROM series s INNER JOIN favoriteseries f ON s.seriesId = f.seriesid
                     WHERE f.userid = $userId AND(SELECT count(*) as a FROM episodes e
                                                    WHERE e.seriesid = f.seriesid AND e.episodeId NOT in(
                                                        SELECT episodeId FROM seenepisodes WHERE userid = $userId)
                    ) > 0";
        $query = $this->db->query($queryStr);
        //$query = $this->db->query('SELECT * FROM series s INNER JOIN favoriteseries f ON f.seriesid = s.seriesid WHERE f.userid ='. $userId .' and (select count(*) from episodes ');
        return $query->result();
    }

    function list_unseen_episodes_for_series($userId, $seriesId) {
        $queryStr = "SELECT e.*, s.seasonNr FROM episodes e inner join seasons s on s.seasonid=e.seasonid WHERE s.seriesid = $seriesId AND e.episodeId NOT in (SELECT episodeId FROM seenepisodes WHERE userid = $userId)";
        $query = $this->db->query($queryStr);

        return $query->result();
    }

}

?>