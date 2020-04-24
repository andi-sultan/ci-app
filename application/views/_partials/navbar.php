<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url() ?>" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-user"></i>
        <?php if (isset($this->session->userdata['ciAppUser'])) {
          echo $this->session->userdata['ciAppUser'][0]->username;
        } ?> <i class="fas fa-caret-down"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right text-sm">
        <span class="dropdown-item dropdown-header">
          <?php if (isset($this->session->userdata['ciAppUser'])) {
            echo $this->session->userdata['ciAppUser'][0]->name;
          } ?></span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-cogs"></i> Settings
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url() ?>user_logout" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      </div>
    </li>
  </ul>

</nav>
<!-- /.navbar -->
