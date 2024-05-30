<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="user_image/<?php echo $row['img']; ?>" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo substr(ucfirst($row['name']), 0, 15) . "..."; ?></span>
          <span class="text-secondary text-small">@<?php echo $row['username']; ?></span>
        </div>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home-outline menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/products.php">
        <span class="menu-title">Products</span>
        <i class="mdi mdi-package-variant-closed-check menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/addProduct.php">
        <span class="menu-title">Add Products</span>
        <i class="mdi mdi-package-variant-closed menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/newsletterSend.php">
        <span class="menu-title">Newsletter</span>
        <i class="mdi mdi-email-variant menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/reportFallacy.php">
        <span class="menu-title">Report Fallacy</span>
        <i class="mdi mdi-alert-octagon menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="profile.php">
        <span class="menu-title">My Profile</span>
        <i class="mdi mdi-account-outline menu-icon"></i>
      </a>
  </ul>
</nav>