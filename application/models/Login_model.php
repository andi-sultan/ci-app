<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
  public function find_user($data)
  {
    $query = $this->db->get_where('user', array(
      'username' => $data['username'],
      'password' => md5($data['password'])
    ));
    if (count($query->result()) > 0){
      return $query->result();
    }
  }
}
