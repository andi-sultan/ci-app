<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes_model extends CI_Model
{
  public function load_data()
  {
    return ($this->db->get('notes', 10)->result());
  }
}
/* End of file Notes_model.php */