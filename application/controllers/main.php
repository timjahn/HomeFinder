<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->config->load('homefinder');
	}
	
	public function index()
	{
		$this->data['area'] = "";
		$this->data['propertyType'] = "";
		$this->data['bed'] = "";
		$this->data['bath'] = "";
		$this->data['extra'] = "";
		$this->data['page'] = "";
		if ($this->uri->segment(2)=="search") {
			// Perform search via HomeFinder API
			$this->data['area'] = urldecode($this->uri->segment(3));
			$this->data['propertyType'] = $this->uri->segment(4);
			$this->data['bed'] = $this->uri->segment(5);
			$this->data['bath'] = $this->uri->segment(6);
			$this->data['extra'] = $this->uri->segment(7);
			$this->data['page'] = $this->uri->segment(8);
			if ($this->data['page']=="") {
				$this->data['page'] = 1;
			} else {
				$this->data['page'] = (($this->data['page']+1)/$this->config->item('hf_per_page'));
			}
			$parameters = array('area' => $this->data['area'], 'propertyType' => $this->data['propertyType'], 'bed' => $this->data['bed'], 'bath' => $this->data['bath']);
			$url = $this->config->item('hf_api_base_url')."?";
			$url .= http_build_query($parameters)."&".$this->data['extra']."=true&page=".$this->data['page']."&resultSize=".$this->config->item('hf_per_page')."&apikey=".$this->config->item('hf_api_key');
	
			// Grab data from API
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			$result = json_decode($result);
			curl_close($ch);
			$this->data['error'] = "";
			$this->data['listings'] = "";
			if (!isset($result->status->errorStack)) {
				// Success				
				$this->data['listings'] = $result->data->listings;
				$this->load->library('pagination');
				$config['base_url'] = base_url()."main/search/".$this->data['area']."/".$this->data['propertyType']."/".$this->data['bed']."/".$this->data['bath']."/".$this->data['extra'];
				$config['total_rows'] = $result->data->meta->totalMatched;
				$config['per_page'] = $this->config->item('hf_per_page'); 
				$config['uri_segment'] = 8;
				$config['num_links'] = 3;
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['prev_link'] = false;
				$config['next_link'] = false;
				$this->pagination->initialize($config); 
				$this->data['pagination'] = $this->pagination->create_links();
			} else {
				// Error
				$this->data['error'] = $result->status->errorStack[0]->message;
			}
			$this->data['bath'] = urldecode($this->data['bath']);
			$this->data['bed'] = urldecode($this->data['bed']);
		}
		
		// Load view
		$this->load->helper('form');
		$this->data['hf_property_types'] = $this->config->item('hf_property_types');
		$this->data['hf_extra_options'] = $this->config->item('hf_extra_options');
		$this->data['hf_city_options'] = $this->config->item('hf_city_options');
		$this->data['hf_bed_bath_options'] = $this->config->item('hf_bed_bath_options');
		$this->load->view('search', $this->data);
	}
	
	// Build search URL
	public function preSearch() {
		redirect('main/search/'.$this->input->post('area').'/'.$this->input->post('propertyType').'/'.$this->input->post('bed').'/'.$this->input->post('bath').'/'.$this->input->post('extra'));
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */