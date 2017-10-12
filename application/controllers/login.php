<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->form_validation->set_rules('identity', 'Admin Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$remember = (bool) $this->input->post('remember');
		if($this->input->post()){
			if ($this->form_validation->run() == true){
					if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){ 
							if ($this->ion_auth->logged_in()){
									redirect('admin/dashboard');
							} else {
								redirect('login','refresh');
							}
					}else{
						redirect('login','refresh');
					}
			}else{ 
					//$this->session->set_flashdata('message', $this->ion_auth->errors());
					//redirect('home', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}  else {
			//redirect('home','refresh');
		}
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$data['identity'] = array('name' => 'identity',
			'id' => 'identity',
			'type' => 'text',
			'value' => '',
			'class' => 'form-control',
			'placeholder'=>'User Id'
		);
		$data['password'] = array('name' => 'password',
			'id' => 'password',
			'type' => 'password',
			'value' => '',
			'class' => 'form-control',
			'placeholder'=>'Password'
		);
		
		$this->template->set_template('login');
		$this->template->write_view('content', 'login/index',$data);
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */