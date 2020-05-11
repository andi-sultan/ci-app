<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contacts_model extends CI_Model
{
  function load_data($id = null)
  {
    return ($this->db->query(
      "SELECT * FROM contacts" .
        ($id != null ? " WHERE contacts.id = $id" : '')
    ))->result();
  }

  function save_data($data)
  {
    return isset($data['id']) ? $this->update_data($data) : $this->insert_data($data);
  }

  function insert_data($data)
  {
    $values = array(
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'gender' => $data['gender'],
      'phone_number' => $data['phone_number']
    );
    return $this->db->insert('contacts', $values);
  }

  function update_data($data)
  {
    $values = array(
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'gender' => $data['gender'],
      'phone_number' => $data['phone_number']
    );

    $this->db->where('id', $data['id']);
    return $this->db->update('contacts', $values);
  }

  public function remove_data($id)
  {
    return $this->db->delete('contacts', array('id' => $id));
  }
}

/* End of file Contacts_model.php */
