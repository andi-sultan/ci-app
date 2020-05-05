<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes_model extends CI_Model
{
  function load_data($id = null)
  {
    return ($this->db->query(
      "SELECT * FROM notes" .
        ($id != null ? " WHERE notes.id = $id" : '')
    ))->result();
  }

  function save_data($data)
  {
    return isset($data['id']) ? $this->update_data($data) : $this->insert_data($data);
  }

  function insert_data($data)
  {
    $values = array(
      'title' => $data['title'],
      'content' => $data['content'],
      'date_created' => date("Y-m-d H:i:s"),
      'date_modified' => date("Y-m-d H:i:s")
    );
    return $this->db->insert('notes', $values);
  }

  function update_data($data)
  {
    $values = array(
      'title' => $data['title'],
      'content' => $data['content'],
      'date_modified' => date("Y-m-d H:i:s")
    );

    $this->db->where('id', $data['id']);
    return $this->db->update('notes', $values);
  }

  public function remove_data($id)
  {
    return $this->db->delete('notes', array('id' => $id));
  }
}

/* End of file Notes_model.php */
