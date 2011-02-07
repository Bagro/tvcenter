<?php

class Series_model extends Model {

    function list_series($userId, $offset, $max_per_page) {
        $this->db->select('series.*, favoriteseries.seriesid as favorite');
		$this->db->from('series');
		$this->db->join('favoriteseries', 'series.seriesid = favoriteseries.seriesid and favoriteseries.userid = '. $userId, 'left');
		$this->db->limit($max_per_page, $offset);
		$this->db->orderby('name');
        $query = $this->db->get();
        return $query->result();
    }

	function search_series($userId, $searchstring){
		$this->db->select('series.*, favoriteseries.seriesid as favorite');
		$this->db->from('series');
		$this->db->join('favoriteseries', 'series.seriesid = favoriteseries.seriesid and favoriteseries.userid = '. $userId, 'left');
		$this->db->like('series.name', $searchstring);
		$this->db->orderby('name');
        $query = $this->db->get();
        return $query->result();
	}
	
	function series_count(){
		return $this->db->count_all('series');
	}
	
	function list_favorite_series($userId, $offset, $max_per_page) {
        $this->db->select('series.*, favoriteseries.seriesid as favorite');
		$this->db->from('series');
		$this->db->join('favoriteseries', 'series.seriesid = favoriteseries.seriesid and favoriteseries.userid = '. $userId);
		$this->db->limit($max_per_page, $offset);
		$this->db->orderby('name');
        $query = $this->db->get();
        return $query->result();
    }

	function favorite_series_count($userId){
		$this->db->from('series');
		$this->db->join('favoriteseries', 'series.seriesid = favoriteseries.seriesid and favoriteseries.userid = '. $userId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
    function list_favorite_series_with_unseen_episodes($userId) {
        $queryStr = "SELECT s.* FROM series s INNER JOIN favoriteseries f ON s.seriesId = f.seriesid
                     WHERE f.userid = $userId AND(SELECT count(*) as a FROM episodes e
                                                    WHERE e.seriesid = f.seriesid AND e.episodeId NOT in(
                                                        SELECT episodeId FROM seenepisodes WHERE userid = $userId)
                    ) > 0 order by s.name";
        $query = $this->db->query($queryStr);
        
        return $query->result();
    }

	function list_episodes_for_series($userId, $seriesId){
		$this->db->select('episodes.*, seasons.seasonNr, seenepisodes.episodeid as seen, downloads.id as download');
		$this->db->from('episodes');
		$this->db->join('seasons', 'seasons.seasonId = episodes.seasonId');
		$this->db->join('episodefiles', 'episodefiles.episodeid = episodes.episodeid');
		$this->db->join('downloads', 'downloads.fileId = episodefiles.fileId and downloads.userId='. $userId, 'left');
		$this->db->join('seenepisodes', 'seenepisodes.episodeid = episodes.episodeid and seenepisodes.userid='. $userId, 'left');
		$this->db->where('episodes.seriesid ='. $seriesId);
		$this->db->order_by('seasons.seasonNr');
		$this->db->order_by('episodes.episodeNr');
		
		$query = $this->db->get();
		return $query->result();
	}

    function list_unseen_episodes_for_series($userId, $seriesId) {
		/*$queryStr = "SELECT e.*, s.seasonNr FROM episodes e 
						inner join seasons s on s.seasonid=e.seasonid 
                     WHERE s.seriesid = $seriesId AND e.episodeId NOT in (SELECT episodeId FROM seenepisodes WHERE userid = $userId) order by s.seasonNr, e.episodeNr";*/
        $queryStr = "SELECT e.*, s.seasonNr, d.id as download FROM episodes e 
						inner join seasons s on s.seasonid=e.seasonid 
						inner join episodefiles ef ON ef.episodeId = e.episodeId
						left outer join downloads d ON d.fileId = ef.fileId and d.userid=$userId
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
	
	function toggle_favorite($userId, $seriesId){
		$this->db->from('favoriteseries');
		$this->db->where('userid', $userId);
		$this->db->where('seriesid', $seriesId);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$this->db->delete('favoriteseries', array('userid' => $userId, 'seriesid' => $seriesId));
			return 'notfavorite';
		}
		else
		{
			$this->db->insert('favoriteseries', array('userid' => $userId, 'seriesid' => $seriesId));
			return 'favorite';
		}
	}
	
	function list_episodes_ordered_by_date($page, $max_per_page, $sortDESC = true)
	{		
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
	
	function get_episode($episodeId, $userId)
	{
		$this->db->select('episodes.*, seenepisodes.episodeid as seen');
		$this->db->from('episodes');
		$this->db->join('seenepisodes', 'seenepisodes.episodeid = episodes.episodeid and seenepisodes.userid='. $userId, 'left');
		$this->db->where('episodes.episodeId', $episodeId);

		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_files(){
		$this->db->orderby('fullname');
		$query = $this->db->get('episodefiles');
		return $query->result();
	}
	
	/* Admin specific*/
	function admin_list_series($offset, $max_per_page) {
        /*$this->db->select('*');*/
		$this->db->from('series');		
		$this->db->limit($max_per_page, $offset);
		$this->db->orderby('name');
        $query = $this->db->get();
        return $query->result();
    }
	
	function admin_list_episodes_for_series($seriesId){
		$this->db->select('episodes.*, seasons.seasonNr');
		$this->db->from('episodes');
		$this->db->join('seasons', 'seasons.seasonId = episodes.seasonId');
		$this->db->where('episodes.seriesid ='. $seriesId);
		$this->db->order_by('seasons.seasonNr');
		$this->db->order_by('episodes.episodeNr');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function admin_get_episode($episodeId){
		$this->db->from('episodes');
		$this->db->where('episodeid = '. $episodeId);
		
		$query = $this->db->get();
		return $query->result();
	}
}

?>