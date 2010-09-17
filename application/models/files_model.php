<?php

class Files_model extends Model{
	
	function GetFullFileName($episodeId){
		$this->db->select('fullname');
		$this->db->from('episodefiles');
		$this->db->where('episodeId', $episodeId);
		$query = $this->db->get();
		
		return $query;
	}
}
?>