<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('notes_model');
  }

  public function total_rows()
  {
    $query = $this->db->select("COUNT(*) as num")->get("notes");
    $result = $query->row();
    if (isset($result)) return $result->num;
    return 0;
  }

  public function search_query($search, $valid_columns)
  {
    if (!empty($search)) {
      $first_column = true;
      foreach ($valid_columns as $sterm) {
        $first_column ? $this->db->like($sterm, $search) : $this->db->or_like($sterm, $search);
        $first_column = false;
      }
    }
  }

  public function dataTable()
  {
    if (is_login()) {
      $draw   = intval($this->input->post("draw"));
      $start  = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
      $order  = $this->input->post("order");
      $search = $this->input->post("search");
      $search = $search['value'];

      $col = 0;
      $dir = "";
      if (!empty($order)) {
        foreach ($order as $o) {
          $col = $o['column'];
          $dir = $o['dir'];
        }
      }

      // If no order is provided by the user,it will be descending (desc)
      if ($dir != "asc" && $dir != "desc") $dir = "desc";

      // while mysql takes column name for sorting, 
      // datatables uses integer numbers as columns
      $valid_columns = array(
        // match table column index to sql column name
        0 => 'title',
        1 => 'date_created',
        2 => 'date_modified'
      );
      !isset($valid_columns[$col]) ? $ordr = null : $ordr = $valid_columns[$col];
      if ($ordr != null) $this->db->order_by($ordr, $dir);

      $this->search_query($search, $valid_columns);

      $this->db->limit($length, $start);
      $notes = $this->db->get("notes");
      $data = array();
      foreach ($notes->result() as $rows) {
        $data[] = array(
          "<b>" . substr($rows->title, 0, 80) . (strlen($rows->title) > 80 ? '...' : '') . "</b><br>"
            . substr($rows->content, 0, 80) . (strlen($rows->content) > 80 ? '...' : ''),
          $rows->date_created,
          $rows->date_modified,
          '<div class="row">
            <div class="col-6">
              <a href="' . base_url() . 'notes/edit?id=' . $rows->id . '">
                <button class="btn btn-block btn-success float-right" data-toggle="tooltip" title="Edit">
                  <i class="fas fa-pen-square text-lg"></i>
                </button>
              </a>
            </div>
            <div class="col-6">
              <button class="btn btn-block btn-danger float-right delete" 
                note-id="' . $rows->id . '" 
                note-title="' . substr($rows->title, 0, 80) . (strlen($rows->title) > 80 ? '...' : '') . '" 
                data-toggle="tooltip" title="Delete">
                <i class="fas fa-trash text-lg"></i>
              </button>
            </div>
          </div>'
        );
      }
      // count total notes in table
      $total_notes = $this->total_rows();
      // create new query to count search filtered results
      $this->search_query($search, $valid_columns);
      // then count it again
      $total_notes_result = $this->total_rows();
      $output = array(
        "draw" => $draw,
        "recordsTotal" => $total_notes,
        "recordsFiltered" => $total_notes_result,
        "data" => $data
      );
      echo json_encode($output);
      exit();
    }
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
    if (is_login()) {
      if (!empty($this->input->post('id'))) $data['id'] = $this->input->post('id');
      $data['title'] = $this->input->post('title');
      $data['content'] = $this->input->post('content');
      $result = $this->notes_model->save_data($data);
      echo json_encode($result);
    }
  }

  public function delete()
  {
    if (is_login()) {
      $id = $this->input->post('id');
      $result = $this->notes_model->remove_data($id);
      echo json_encode($result);
    }
  }

  public function index()
  {
    if (is_login()) {
      $page['title'] = 'Notes';
      $this->load->view('notes/view', $page);
    }
  }
}

/* End of file  Notes.php */
