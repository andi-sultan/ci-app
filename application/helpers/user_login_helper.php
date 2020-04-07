<?php defined('BASEPATH') or exit('No direct script access allowed');
function is_login()
{
  if (!empty($_SESSION['logged_in'])) {
    return true;
  }
}
