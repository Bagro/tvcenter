<?php

class Series_model extends Model {

    function list_series($page, $max_per_page) {
        $this->db->orderby('name');
        $query = $this->db->get('series', $max_per_page, $max_per_page * ($page - 1));
        return $query->result();
    }

    function list_favorite_series_with_unseen_episodes($userId) {
        $queryStr = "SELECT s.* FROM series s INNER JOIN favoriteseries f ON s.seriesId = f.seriesid
                     WHERE f.userid = $userId AND(SELECT count(*) as a FROM episodes e
                                                    WHERE e.seriesid = f.seriesid AND e.episodeId NOT in(
                                                        SELECT episodeId FROM seenepisodes WHERE userid = $userId)
                    ) > 0 order by s.name";
        $query = $this->db->query($queryStr);
        //$query = $this->db->query('SELECT * FROM series s INNER JOIN favoriteseries f ON f.seriesid = s.seriesid WHERE f.userid ='. $userId .' and (select count(*) from episodes ');
        return $query->result();
    }

    function list_unseen_episodes_for_series($userId, $seriesId) {
        $queryStr = "SELECT e.*, s.seasonNr FROM episodes e inner join seasons s on s.seasonid=e.seasonid 
                     WHERE s.seriesid = $seriesId AND e.episodeId NOT in (SELECT episodeId FROM seenepisodes WHERE userid = $userId) order by s.seasonNr, e.episodeNr";
        $query = $this->db->query($queryStr);

        return $query->result();
    }

	function toggle_episode_seen_status($userid, $episodeid){
		$queryStr = "select * from seenepisodes where userid=$userid and episodeid=$episodeid";
		$query = $this->db->query($queryStr);
		
		if($query->num_rows() > 0)
		{
			$queryStr = "delete from seenepisodes where userid=$userid and episodeid=$episodeid";
			$this->db->query($queryStr);
			return 'unseen';
		}
		else
		{
			$queryStr = "insert into seenepisodes (userid,episodeid) values($userid, $episodeid)";
			$this->db->query($queryStr);
			return 'seen';
		}
	}
	
	function list_episodes_ordered_by_date($page, $max_per_page, $sortDESC = true)
	{
		/*"select episodes.*, series.name as seriesname , seasons.seasonNr 
		from episodes 
		inner join series on episodes.seriesId = series.seriesId 
		inner join seasons on episodes.seasonId = seasons.seasonId 
		ORDER BY episodes.created DESC LIMIT $page, $max_per_page";*/
		$this->db->select('episodes.*, series.name as seriesname , seasons.seasonNr');
		$this->db->from('episodes');
		$this->db->join('series', 'series.seriesId = episodes.seriesId');
		$this->db->join('seasons', 'seasons.seasonId = episodes.seasonId');
		if($sortDESC)
			$this->db->orderby('episodes.created', 'desc');
		else
			$this->db->orderby('episodes.created');
		$this->db->limit($max_per_page, $max_per_page * ($page - 1));
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_episode($episodeId)
	{
		$this->db->where('episodeId', $episodeId);
		$query = $this->db->get('episodes');
		return $query->result();
	}
}

?>