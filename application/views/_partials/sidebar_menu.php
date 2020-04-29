<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
  <!-- Brand Logo -->
  <a href="<?php echo base_url() ?>home" class="brand-link">
    <img src="<?php echo base_url(); ?>assets/AdminLTE-3.0.2/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">CI App</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">Menu</li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>notes" class="nav-link <?php echo ($this->uri->segment(1) == 'notes') ? 'active' : '' ?>">
            <i class="fas fa-sticky-note nav-icon"></i>
            <p>Notes</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>address_book" class="nav-link <?php echo ($this->uri->segment(1) == 'address_book') ? 'active' : '' ?>">
            <i class="fas fa-address-book nav-icon"></i>
            <p>Address Book</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
