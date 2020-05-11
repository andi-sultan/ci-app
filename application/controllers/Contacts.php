<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contacts extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('contacts_model');
  }

  public function total_rows()
  {
    $query = $this->db->select("COUNT(*) as num")->get("contacts");
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
        0 => 'first_name',
        1 => 'email',
        2 => 'gender',
        3 => 'phone_number'
      );
      !isset($valid_columns[$col]) ? $ordr = null : $ordr = $valid_columns[$col];
      if ($ordr != null) $this->db->order_by($ordr, $dir);

      $this->search_query($search, $valid_columns);

      $this->db->limit($length, $start);
      $contacts = $this->db->get("contacts");
      $data = array();
      foreach ($contacts->result() as $rows) {
        $data[] = array(
          $rows->first_name . ' ' . $rows->last_name,
          $rows->email,
          $rows->gender,
          $rows->phone_number,
          '<div class="row">
            <div class="col-6">
              <a href="' . base_url() . 'contacts/edit?id=' . $rows->id . '">
                <button class="btn btn-block btn-success float-right" data-toggle="tooltip" title="Edit">
                  <i class="fas fa-pen-square text-lg"></i>
                </button>
              </a>
            </div>
            <div class="col-6">
              <button class="btn btn-block btn-danger float-right delete" 
                contact-id="' . $rows->id . '" 
                contact-name="' . $rows->first_name .' '. $rows->last_name . '" 
                data-toggle="tooltip" title="Delete">
                <i class="fas fa-trash text-lg"></i>
              </button>
            </div>
          </div>'
        );
      }
      // count total contacts in table
      $total_contacts = $this->total_rows();
      // create new query to count search filtered results
      $this->search_query($search, $valid_columns);
      // then count it again
      $total_contacts_result = $this->total_rows();
      $output = array(
        "draw" => $draw,
        "recordsTotal" => $total_contacts,
        "recordsFiltered" => $total_contacts_result,
        "data" => $data
      );
      echo json_encode($output);
      exit();
    }
  }

  public function add()
  {
    if (is_login()) {
      $page['title'] = 'Create New Contact';
      $this->load->view('contacts/editor', $page);
    }
  }

  public function edit()
  {
    if (is_login()) {
      $contact_id = $_GET['id'];
      $page['title'] = 'Edit Contact';
      $page['data'] = $this->contacts_model->load_data($contact_id, 1);
      $this->load->view('contacts/editor', $page);
    }
  }

  public function save()
  {
    if (is_login()) {
      if (!empty($this->input->post('id'))) $data['id'] = $this->input->post('id');
      $data['first_name'] = $this->input->post('first_name');
      $data['last_name'] = $this->input->post('last_name');
      $data['email'] = $this->input->post('email');
      $data['gender'] = $this->input->post('gender');
      $data['phone_number'] = $this->input->post('phone_number');
      $result = $this->contacts_model->save_data($data);
      echo json_encode($result);
    }
  }

  public function delete()
  {
    if (is_login()) {
      $id = $this->input->post('id');
      $result = $this->contacts_model->remove_data($id);
      echo json_encode($result);
    }
  }

  public function index()
  {
    if (is_login()) {
      $page['title'] = 'Contacts';
      $this->load->view('contacts/view', $page);
    }
  }
}

/* End of file Contacts.php */
