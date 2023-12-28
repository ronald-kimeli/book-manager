
<template>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">

        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <RouterLink to="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <!-- <img src="../../assets/images/logos/dark-logo.svg" width="180" alt=""> -->
                  Book Manager
                </RouterLink>
            
                <!-- <p class="text-center">Your Book Manager</p> -->
                <form @submit.prevent="loginUser">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" v-model="User.email" class="form-control" aria-describedby="emailHelp">
                    <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" v-model="User.password" class="form-control">
                    <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
                  </div>
                  <span v-if="errors.error" class="text-danger">{{ errors.error[0] }}</span>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <RouterLink class="text-primary fw-bold" to="#">Forgot Password ?</RouterLink>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In
                  </button>
                  <!-- <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                    <RouterLink class="text-primary fw-bold ms-2" to="/register">Create an account</RouterLink>
                  </div> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';
import { setUser } from '../../stores/userState';

export default defineComponent({
  name: 'loginUser',
  setup() {
    const User = ref({ email: '', password: '' });
    const errors = ref({});

    const router = useRouter();

    const BASE_URL = "http://127.0.0.1:8000/api";

    const loginUser = async () => {
      try {
        // Clear previous errors
        errors.value = {};
        const response = await fetch(`${BASE_URL}/login`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(User.value),
        });

        if (response.ok) {
          const responseData = await response.json();

          if (responseData.status === 'success') {
            setUser({ user: responseData.user, token: responseData.token }); 
            router.push('/dashboard');
          } else {
            console.error('Unexpected response:', responseData);
          }
        } else {
          // Handle non-200 HTTP status codes (e.g., 404, 500)
          console.error('HTTP error:', response.status);
          if (response.status === 500) {
            const responseError = await response.json();
            console.log(responseError);
          }
          if (response.status === 403) {
            const responseError = await response.json();
            // console.log(responseError.errors);
            errors.value = responseError.errors;
          }
          if (response.status === 422) {
            const responseError = await response.json();
            if (responseError && responseError.status === 'error') {
              // console.log(responseError.errors);
              errors.value = responseError.errors;
            }
          }
        }
      } catch (error) {
        console.error('Error creating user:', error);
      }
    };

    return {
      User,
      errors,
      loginUser,
    };
  },
});
</script>

<style scoped></style>