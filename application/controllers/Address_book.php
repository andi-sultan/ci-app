<?php defined('BASEPATH') or exit('No direct script access allowed');

class Address_book extends CI_Controller
{
  public function index()
  {
    if (is_login()) {
      $page['title'] = 'Address Book';
      $page['content'] = 'address_book';
      $this->load->view('home', $page);
    }
  }
}
        
/* End of file  Address_book.php */
