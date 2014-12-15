<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function detail()
	{
		$this->load->helper('api');
		$api_url = $this->config->item( 'api_url');
		$request_url = 'store/detail/id/1/format/json';
		$final_url = $api_url . $request_url;
		$data = my_api_request($final_url , $method = 'get', $param = array());
		//$data = array();
		//$data = my_api_request
		$data = json_decode($data, true);
		$this->load->view('templates/header', 
				array(
						'detail'=>$data
						
				)
		);
		$this->load->view('pages/products', $data);
		$this->load->view('templates/footer', $data);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */