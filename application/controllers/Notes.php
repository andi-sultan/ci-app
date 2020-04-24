<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('notes_model');
  }

  public function add()
  {
    if (is_login()) {
      $page['title'] = 'Create New Notes';
      $this->load->view('notes/add', $page);
    }
  }
  
  public function index()
  {
    if (is_login()) {
      $page['title'] = 'Notes';
      $page['notes_data'] = $this->notes_model->load_data();
      $this->load->view('notes/view', $page);
    }
  }
}

/* End of file  Notes.php */
