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
	
	protected function uploadImg($input_name, &$error){
		if ( ! $this->upload->do_upload($input_name))
		{
			$error = $this->upload->display_errors();
			return  false;
		}
		else
		{
			$this->data['upload_data'] = $this->upload->data();
			$filepath = $this->data['upload_data']['file_name'];
			return $filepath;
	
			//$this->load->view('upload_success', $this->data);
		}
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function detail()
	{
		
		$request_url = 'store/detail/id/1/format/json';	
		$this->data = array();
		$detail = my_api_request($request_url , $method = 'get', $param = array());
		//$this->data = array();
		//$this->data = my_api_request
		$this->data['detail'] = json_decode($detail, true);
		$this->load->view('templates/header', 
				$this->data
		);
		$this->load->view("pages/". $this->data['router'] . "/" . $this->data['action'], $this->data);
		$this->load->view('templates/footer', $this->data);
		
	}
	
	public function create()
	{		
		$router = $this->router->class;
		$action = $this->router->method;
		
		
		$this->data['title'] = $this->lang->line('createproduct');
	
		
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

		$this->load->view('templates/header', $this->data);
		//invalid or first load, load page normally
		if ($this->form_validation->run() === FALSE)
		{
		
			
		
		}
		//process upload
		else
		{
			//product entity
			$request = array(
					'name'=>$this->input->post('productname'),
					'category_id'=>$this->input->post('category'),
					'price'=>$this->input->post('price'),
					'description'=>$this->input->post('description'),
					
					//''=>$this->input->post(''),
			);
			
			//init upload lib
			$upload_config['upload_path'] =  $this->config->item( 'cdn_path') . 'product/';
			$upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
			$upload_config['remove_spaces']  = TRUE;
			$upload_config['max_size']	= '1000';
			$upload_config['max_width']  = '1024';
			$upload_config['max_height']  = '768';
			
			$this->load->library('upload', $upload_config);
			$errors = array();
			$images = array();
			//read imgs
			for($i = 1; $i <=10; $i++)
			{
			
				if(isset($_FILES['thumbnail' . $i]))
				{
				  $upload_name = 'thumbnail' . $i;
				  $img_url =  $this->uploadImg($upload_name, $errors);
				  $images[] = $img_url;
				  
				}
				else
				{
					break;
				}
			}
			
			if(count($errors) > 0)
			{
				$this->data['errors'] = $errors;
			}
			else
			{
				$request['img'] = implode(',',$images);
				//call create api
				$this->load->helper('api');
				$api_url = $this->config->item( 'api_url');
				$request_url = 'product/detail/format/json';
				$final_url = $api_url . $request_url;

				$resp = my_api_request($final_url , $method = 'post', $request);
				
				$this->data['resp'] = json_decode($resp,true);
				
			}
			
			
		}
		$this->load->view("pages/". $this->data['router'] . "/" . $this->data['action'], $this->data);
		$this->load->view('templates/footer');
		
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */