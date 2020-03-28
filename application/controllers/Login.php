<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function index()
  {
    $page['title'] = 'Home';
    $this->load->view('login', $page);
  }
}
