<?php defined('BASEPATH') or exit('No direct script access allowed');
function is_login()
{
  if ($_SESSION['logged_in'] == 'ciAppLogin') {
    return true;
  } else {
    redirect('login_first');
  }
}
