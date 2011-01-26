<?php
class Adminepisode extends Controller{
	function __construct() {
        parent::Controller();

        if (!is_logged_in() && !is_in_group(4))
            redirect('login/index');

        $this->load->model('Series_model', 'sm');        
    }
	
	function show($episodeId){
		if(is_numeric($episodeId))
		{
			$userId = current_userid();
			$episode = $this->sm->admin_get_episode($episodeId);
			if(count($episode) == 0)
			{
				echo "Could not find episode.";
				return;
			}
			$data['episode'] = $episode[0];
			echo $this->load->view('admin/episodepopup', $data);
		}
	}
	
	function edit($episodeId){
		if(is_numeric($episodeId))
		{
			$userId = current_userid();
			$episode = $this->sm->admin_get_episode($episodeId);
			if(count($episode) == 0)
			{
				echo "Could not find episode.";
				return;
			}
			$data['episode'] = $episode[0];
			echo $this->load->view('admin/editepisodepopup', $data);
		}
	}
}
?>
