<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('login_model');
  }

  public function user_login()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
      if (isset($this->session->userdata['logged_in'])) {
        redirect('home');
      } else {
        $page['error_message'] = 'Please input all the fields';
        $this->load->view('login', $page);
      }
    } else {
      $data = array(
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password')
      );
      if ($this->login_model->find_user($data) == true) {
        $this->session->set_userdata('logged_in', 'ciAppLogin');
        $this->session->set_userdata('ciAppUser', $data['username']);
        redirect('home');
      } else {
        $page['error_message'] = 'Invalid username or password';
        $this->load->view('login', $page);
      }
    }
  }

  public function index()
  {
    if (is_login()) {
      redirect('home');
    } else {
      $this->load->view('login');
    }
  }
}
