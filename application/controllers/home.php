<?php

class Home extends Controller {

    function __construct() {
        parent::Controller();

        if (!is_logged_in())
            redirect('login/index');

        $this->load->model('Series_model', 'sm');        
    }

    function index() {
        $userId = current_userid();

        $seriesList = $this->sm->list_favorite_series_with_unseen_episodes($userId);
        $i = 0;
        foreach ($seriesList as $series) {
            $episodes = $this->sm->list_unseen_episodes_for_series($userId, $series->seriesId);
            $series->numEpisodes = count($episodes);
            $series->episodes = $episodes;
        }

        $data['series_list'] = $seriesList;
        $data['script_tag'] = '<script type="text/javascript" src="'. base_url() .'/scripts/homeindex.js"> </script>';
        $data['main_content'] = 'home/index';
        $this->load->view('includes/template', $data);
    }

    function toggleseenstatus()
    {
        $episodeId = trim($this->input->post('episodeid'));

        $result = array('status'=>'seen');

        echo json_encode($result);
    }
}

?>