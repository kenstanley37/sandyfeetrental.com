 <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.html">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item active" href="blank.html">Blank Page</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>DBA-120 Views</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="photo.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Property Pictures</span></a>
        </li>
          <li class="nav-item">
            <?php 
                if($rank === 'super_admin'){
                        ?>
                        <button type="submit" id="reset-db" class="btn btn-danger btn-sm"><i class="fas fa-database"></i> RESET DATABASE</button>
                        <?php
                    }
                ?>
          </li>
      </ul>
        