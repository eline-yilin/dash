<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/My_Controller.php';
class product extends My_Controller {

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
		$data = array();
		$detail = my_api_request($final_url , $method = 'get', $param = array());
		//$data = array();
		//$data = my_api_request
		$data['detail'] = json_decode($detail, true);
		$this->load->view('templates/header', 
				$data
		);
		$this->load->view('pages/products/list', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	public function create()
	{
		$data = array();
		$data['title'] = 'Create a news item';
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$validation_rules = array(
				array(
						'field'   => 'productname',
						'label'   => 'productname',
						'rules'   => 'required'
				),
				/* array(
						'field'   => 'password',
						'label'   => 'Password',
						'rules'   => 'required'
				),
				array(
						'field'   => 'passconf',
						'label'   => 'Password Confirmation',
						'rules'   => 'required'
				), */
				
		);
		
		$this->form_validation->set_rules($validation_rules);

		$this->load->view('templates/header', $data);
		
		if ($this->form_validation->run() === FALSE)
		{
			
			$this->load->view('pages/products/create');
			
		
		}
		else
		{
			$upload_config['upload_path'] =  $this->config->item( 'cdn_path') . 'products/';
			$upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces']  = TRUE;
			$upload_config['max_size']	= '1000';
			$upload_config['max_width']  = '1024';
			$upload_config['max_height']  = '768';
			
			$this->load->library('upload', $upload_config);
			
			if ( ! $this->upload->do_upload('thumbnail1'))
			{
				$error = array('error' => $this->upload->display_errors());
			
				$this->load->view('pages/products/create', $error);
			}
			else
			{
				$data['upload_data'] = $this->upload->data();
				$filepath = $data['upload_data']['file_name'];
				$request = array();
				
				$this->load->helper('api');
				$api_url = $this->config->item( 'api_url');
				$request_url = 'store/detail/format/json';
				$final_url = $api_url . $request_url;
				$data = my_api_request($final_url , $method = 'post', $request);
				$this->load->view('pages/products/create', $error);
				//$this->load->view('upload_success', $data);
			}
			//$this->news_model->set_news();
			//$this->load->view('news/success');
		}
		
		$this->load->view('templates/footer');
		//$detail = my_api_request($final_url , $method = 'get', $param = array());
		//$data = array();
		//$data = my_api_request
		//$data['detail'] = json_decode($detail, true);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */