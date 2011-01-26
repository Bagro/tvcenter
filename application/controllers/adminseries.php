<?php
class Adminseries extends Controller {

    function __construct() {
        parent::Controller();

        if (!is_logged_in() && !is_in_group(4))
            redirect('login/index');

        $this->load->model('Series_model', 'sm');        
    }

	function index(){
		$this->generatePage(1);
	}
	
	function page($offset=0){
		$this->generatePage($offset);
	}
	
	private function generatePage($offset){
		$userId = current_userid();
		
		$seriesList = $this->sm->admin_list_series($offset, 10);
		
		foreach ($seriesList as $series) {
            $episodes = $this->sm->admin_list_episodes_for_series($series->seriesId);
            $series->numEpisodes = count($episodes);
            $series->episodes = $episodes;
        }

		$this->load->library('pagination');

		$config['base_url'] = base_url() .'adminseries/page/';
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
		$data['script_tag'] = '<script type="text/javascript" src="'. base_url() .'/scripts/admin.js"> </script>';
		$data['left_content'] = 'home/episodeslist';
        $data['main_content'] = 'admin/series';
		$this->load->view('includes/admintemplate', $data);
	}
		
	function search(){
		
	}
	
}
?>