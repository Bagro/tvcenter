<?php

class Files_model extends Model{
	
	function GetFullFileName($episodeId){
		$this->db->select('fullname, fileId');
		$this->db->from('episodefiles');
		$this->db->where('episodeId', $episodeId);
		$query = $this->db->get();
		
		return $query;
	}
	
	function RegisterDownload($userId, $fileId, $ip){
		$this->load->helper('date');
		$data = array(
						'userid' => $userId,
						'fileid' => $fileId,
						'ip' => $ip,
						'dltime' => mdate('%Y-%m-%d %H:%m:%s')
					);
		$this->db->insert('downloads', $data);
	}
}
?>