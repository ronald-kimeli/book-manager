

<template>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <RouterLink to="/dashboard" class="text-nowrap logo-img">
            <!-- <img src="../../assets/images/logos/dark-logo.svg" width="180" alt="" /> -->
            Book Manager
          </RouterLink>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="/dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </RouterLink>
            <!-- </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">UI COMPONENTS</span>
            </li>
            <li class="sidebar-item"> -->
              <!-- <RouterLink class="sidebar-link" to="/buttons" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Buttons</span>
              </RouterLink> -->
            </li>
            <!-- <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="#" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Alerts</span>
              </RouterLink>
            </li> -->
            <!-- <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="/cards" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Card</span>
              </RouterLink>
            </li> -->
            <!-- <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="/list" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Forms</span>
              </RouterLink>
            </li> -->
            <!-- <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="#" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Typography</span>
              </RouterLink>
            </li> -->
            <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="/books" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Books</span>
              </RouterLink>
            </li>
            <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="/users" aria-expanded="false">
                <span>
                  <i class="ti ti-user fs-6"></i>
                </span>
                <span class="hide-menu">Users</span>
              </RouterLink>
            </li>
            <!-- <li class="sidebar-item">
              <RouterLink class="sidebar-link" to="/languages" aria-expanded="false">
                <span>
                  <i class="ti ti-user fs-6"></i>
                </span>
                <span class="hide-menu">Languages</span>
              </RouterLink>
            </li> -->
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
</template>



<style scoped>

</style>