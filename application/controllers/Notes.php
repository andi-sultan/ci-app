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
      $this->load->view('notes/editor', $page);
    }
  }

  public function edit()
  {
    if (is_login()) {
      $note_id = $_GET['id'];
      $page['title'] = 'Edit Notes';
      $page['data'] = $this->notes_model->load_data($note_id, 1);
      $this->load->view('notes/editor', $page);
    }
  }

  public function save()
  {
    if(is_login()){
      $this->input->post('id')!=''? $data['id'] = $this->input->post('id'):'';
      $data['title'] = $this->input->post('title');
      $data['content'] = $this->input->post('content');
      $result = $this->notes_model->save_data($data);
      echo json_encode($result);
    }
  }

  public function index()
  {
    if (is_login()) {
      $page['title'] = 'Notes';
      $page['notes_data'] = $this->notes_model->load_data(null, 30);
      $this->load->view('notes/view', $page);
    }
  }
}

/* End of file  Notes.php */
