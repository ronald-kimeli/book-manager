
<template>
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <RouterLink class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" to="#">
                <i class="ti ti-menu-2"></i>
              </RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link nav-icon-hover" to="#">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </RouterLink>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <RouterLink class="nav-link nav-icon-hover" to="#" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </RouterLink>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <RouterLink to="#" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3" v-if="user">{{user.name}}</p>
                      <p class="mb-0 fs-3" v-else>My Profile</p>
                    </RouterLink>
                    <!-- <RouterLink to="#" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </RouterLink>
                    <RouterLink to="#" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </RouterLink> -->
                    <button @click="logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
</template>


<script>
import { getUser } from '../../stores/userState';


import { defineComponent } from 'vue';
import { getToken } from '../../stores/userState';
import { useRouter } from 'vue-router';

export default defineComponent({
  name: 'Logout',
  setup() {

    const BASE_URL = "http://localhost:8000/api";
    const token = getToken();
    const router = useRouter();
    const user = getUser();

    const logout = async () => {
    try {
      const response = await fetch(`${BASE_URL}/logout`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
        },
      });

      if (response.ok) {
        router.push('/');
        // return { success: true, message: 'Logged out successfully!' };
      } else {
        throw new Error('Logout failed!');
      }
    } catch (error) {
      // Handle error, if any
      console.error('Logout error:', error);
      return { success: false, message: 'Logout failed!' };
    }
  };

  return {
    logout,
    user
  };
  },
});
</script>

<style scoped>

</style>