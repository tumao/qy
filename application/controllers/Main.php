<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	
	public function index()
	{
		$this->load->view('baseview/header');
		// $this->load->view('data/index');
		$this->load->view('baseview/footer');
	}

	
}
