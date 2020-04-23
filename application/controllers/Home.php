<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		if (is_login()) {
			$page['title'] = 'Home';
			$page['content'] = 'dashboard';
			$this->load->view('home', $page);
		}
	}
}
