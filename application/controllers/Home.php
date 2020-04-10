<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		if (is_login()) {
			$page['title'] = 'Home';
			$page['content'] = 'editor';
			$this->load->view('home', $page);
		}
	}
}
