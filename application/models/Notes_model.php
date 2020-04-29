<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes_model extends CI_Model
{
  function load_data($id = null, $limit = 1)
  {
    return ($this->db->query(
      "SELECT * FROM notes" . ($id != null ? " WHERE notes.id = $id" : '') . " LIMIT $limit"
    ))->result();
  }

  function save_data($data)
  {
    return isset($data['id']) ? $this->update_data($data) : $this->insert_data($data);
  }

  function insert_data($data)
  {
    $date_created = date("Y-m-d H:i:s");
    $date_modified = date("Y-m-d H:i:s");
    return ($this->db->query(
      "INSERT INTO notes ( title, content, date_created, date_modified )
        VALUES
          ( '" . $data['title'] . "', '" . $data['content'] . "', '" . $date_created . "', '" . $date_modified . "' )"
    ));
  }

  function update_data($data)
  {
    $date_modified = date("Y-m-d H:i:s");
    return ($this->db->query(
      "UPDATE notes SET title='" . $data['title'] . "',content='" . $data['content'] . "',date_modified='" . $date_modified . "' WHERE id=" . $data['id']
    ));
  }
}
/* End of file Notes_model.php */
