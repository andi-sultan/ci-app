<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes extends CI_Controller
{
  public function index()
  {
    if (is_login()) {
      $page['title'] = 'Notes';
      $page['content'] = 'notes/view';
      $page['page_script'] = 'notes/scripts';
      $this->load->view('home', $page);
    }
  }
}

/* End of file  Notes.php */
