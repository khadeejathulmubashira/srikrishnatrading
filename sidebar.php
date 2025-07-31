<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<hr class="horizontal light mt-0 mb-2">
<div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'add_testimonial.php') ? 'active bg-gradient-primary' : ''; ?>" href="add_testimonial.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">dashboard</i>
        </div>
        <span class="nav-link-text ms-1">Manage Testimonials</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'add_carrier.php') ? 'active bg-gradient-primary' : ''; ?>" href="add_carrier.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">table_view</i>
        </div>
        <span class="nav-link-text ms-1">Manage Carriers</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'manage_sectors.php') ? 'active bg-gradient-primary' : ''; ?>" href="manage_sectors.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">view_in_ar</i>
        </div>
        <span class="nav-link-text ms-1">Manage Sectors</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'manage_subsector.php') ? 'active bg-gradient-primary' : ''; ?>" href="manage_subsector.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">receipt_long</i>
        </div>
        <span class="nav-link-text ms-1">Manage SubSectors</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'manage_product.php') ? 'active bg-gradient-primary' : ''; ?>" href="manage_product.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
        </div>
        <span class="nav-link-text ms-1">Manage Products</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'manage_catalogue.php') ? 'active bg-gradient-primary' : ''; ?>" href="manage_catalogue.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">notifications</i>
        </div>
        <span class="nav-link-text ms-1">Manage catalogue</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'manage_partners.php') ? 'active bg-gradient-primary' : ''; ?>" href="manage_partners.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">person</i>
        </div>
        <span class="nav-link-text ms-1">Manage Partners</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'manage_gallery.php') ? 'active bg-gradient-primary' : ''; ?>" href="manage_gallery.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">login</i>
        </div>
        <span class="nav-link-text ms-1">Manage Videos</span>
      </a>
    </li>

    <!-- <li class="nav-item">
      <a class="nav-link text-white <?php echo ($current_page == 'sign-up.php') ? 'active bg-gradient-primary' : ''; ?>" href="sign-up.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">assignment</i>
        </div>
        <span class="nav-link-text ms-1">Sign Up</span>
      </a>
    </li> -->
  </ul>
</div>
