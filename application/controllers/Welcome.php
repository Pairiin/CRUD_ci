<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('admin');
	}
	
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($id = null)
	{
		
		// $this->load->model('Admin');
		// $this->load->helper('url');

		$this->save_item();
		$this->load->view('welcome_message', [
				'items' => $this->admin->get_items(),
				'item' => $this->admin->get_item_by_id($id)
			]);
	}

	public function delete($id)
	{
		$this->admin->delete_item($id);
		redirect(base_url('/'));

	}

	private function save_item()
	{
		$input = $this->input->post();
		if(!empty($input)){
				if(empty($input['id'])){
					$this->admin->create_item($input);
				}	
				else{
					$this->admin->update_item($input['id'] , $input);
				}
		redirect(base_url('/'));
		}
	}
}
