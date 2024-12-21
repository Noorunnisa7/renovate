      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo">
              <img
                src="../assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a
                  href="/dashboard"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
          
                </a>
               
              </li>
              
              <li class="nav-item active submenu">
                <a data-bs-toggle="collapse" href="#tables">
                  <i class="fas fa-table"></i>
                  <p>User Listing</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse show" id="tables">
                  <ul class="nav nav-collapse">
                  <li>
                      <a href="/list">
                        <span class="sub-item">Admin</span>
                      </a>
                    </li>
                    {{-- <li>
                      <a href="../tables/tables.html">
                        <span class="sub-item">Agent</span>
                      </a>
                    </li>
                    <li class="active">
                      <a href="../tables/datatables.html">
                        <span class="sub-item">Supervisor</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="/leads/list">
                  <i class="fas fa-file"></i>
                  <p>Leads</p>
                </a>
              </li>
             
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->