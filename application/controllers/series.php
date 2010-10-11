<?php

class Series extends Controller{
	
	function __construct(){
		parent::Controller();
		
		if (!is_logged_in())
            redirect('login/index');

        $this->load->model('Series_model', 'sm');
	}
	
	function index(){
		$this->generatePage(1);
	}
	
	function page($offset=0){
		$this->generatePage($offset);
	}

	function favorites(){
		$this->generateFavoritePage(1);
	}
	
	function favoritespage($offset=0){
		$this->generateFavoritePage($offset);
	}
	
	function togglefavorite(){
		$favoriteId = trim($this->input->post('favoriteid'));
		if(is_numeric($favoriteId))
			$status = $this->sm->toggle_favorite(current_userid(), $favoriteId);
		else
			$status = '';
			
        $result = array('status' => $status);

        echo json_encode($result);
	}
	
	private function generatePage($offset){
		$userId = current_userid();
		
		$seriesList = $this->sm->list_series($userId, $offset, 10);
		
		foreach ($seriesList as $series) {
            $episodes = $this->sm->list_episodes_for_series($userId, $series->seriesId);
            $series->numEpisodes = count($episodes);
            $series->episodes = $episodes;
        }

		$this->load->library('pagination');

		$config['base_url'] = base_url() .'series/page/';
		$config['total_rows'] = $this->sm->series_count();
		$config['per_page'] = '10';
		$config['first_link'] = 'Första';
		$config['last_link'] = 'Sista';
		$config['num_links'] = '5';
		
		$this->pagination->initialize($config);

		$data['pagenation'] = $this->pagination->create_links();

		$latestEpisodes = $this->sm->list_episodes_ordered_by_date(1,10);
		$data['list_title'] = 'Serier';
		$data['episodes_list'] = $latestEpisodes;
		$data['series_list'] = $seriesList;
		$data['script_tag'] = '<script type="text/javascript" src="'. base_url() .'/scripts/homeindex.js"> </script>';
		$data['main_content'] = 'series/index';
		$data['left_content'] = 'home/episodeslist';
        $this->load->view('includes/template', $data);
	}
	
	private function generateFavoritePage($offset){
		$userId = current_userid();
		
		$seriesList = $this->sm->list_favorite_series($userId, $offset, 10);
		
		foreach ($seriesList as $series) {
            $episodes = $this->sm->list_episodes_for_series($userId, $series->seriesId);
            $series->numEpisodes = count($episodes);
            $series->episodes = $episodes;
        }

		$this->load->library('pagination');

		$config['base_url'] = base_url() .'series/favoritespage/';
		$config['total_rows'] = $this->sm->favorite_series_count($userId);
		$config['per_page'] = '10';
		$config['first_link'] = 'Första';
		$config['last_link'] = 'Sista';
		$config['num_links'] = '5';
		
		$this->pagination->initialize($config);

		$data['pagenation'] = $this->pagination->create_links();

		$latestEpisodes = $this->sm->list_episodes_ordered_by_date(1,10);
		$data['list_title'] = 'Favoriter';
		$data['episodes_list'] = $latestEpisodes;
		$data['series_list'] = $seriesList;
		$data['script_tag'] = '<script type="text/javascript" src="'. base_url() .'/scripts/homeindex.js"> </script>';
		$data['main_content'] = 'series/index';
		$data['left_content'] = 'home/episodeslist';
        $this->load->view('includes/template', $data);
	}
}

?>