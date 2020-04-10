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
      if ($this->login_model->find_user($data)) {
        $this->session->set_userdata('logged_in', 'ciAppLogin');
        $this->session->set_userdata('ciAppUser', $this->login_model->find_user($data));
        redirect('home');
      } else {
        $page['error_message'] = 'Invalid username or password';
        $this->load->view('login', $page);
      }
    }
  }

  public function user_logout()
  {
    if (is_login()) {
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('ciAppUser');
      $page['login_message'] = 'You have been logout';
      $this->load->view('login', $page);
    } else {
      $this->load->view('login');
    }
  }

  public function index()
  {
    if ($_SESSION['logged_in'] == 'ciAppLogin') {
      redirect('home');
    } else {
      $page['login_message'] = null;
      // if user access user pages (homepage etc.) directly but have not logged in,
      if ($this->uri->segment(1) == 'login_first') {
        // then add login message
        $page['login_message'] = 'Please login first';
      }
      $this->load->view('login', $page);
    }
  }
}
