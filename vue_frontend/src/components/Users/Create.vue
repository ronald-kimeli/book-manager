<template>
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Add User</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">Users</li>
              </ol>
            </nav>
          </div>
          <div class="col-3">
            <div class="text-center mb-n5">
              <img src="../assets/images/breadcrumb/rocket.png" alt="" class="img-fluid mb-n4" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="product-list">
      <div class="card shadow rounded">
        <div class="card-header">
          <h4 class="d-inline">
            <RouterLink to="/users" class="btn btn-sm btn-dark float-end">Users</RouterLink>
          </h4>
        </div>
        <div class="card-body">
          <form @submit.prevent="createUser">
            <div class="form-group">
              <label for="name">Name:</label>
              <input v-model="newUser.name" type="text" id="name" class="form-control" />
              <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input v-model="newUser.email" type="email" id="email" class="form-control" />
              <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
            </div>
            <div class="form-group">
              <label for="role_id">Role:</label>
              <input v-model="newUser.role_id" type="number" id="role_id"  class="form-control" />
              <span v-if="errors.role_id" class="text-danger">{{ errors.role_id[0] }}</span>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input v-model="newUser.password" type="password" id="password" class="form-control" />
              <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
            </div>
            <div class="form-group">
              <label for="password">Password Confirmation:</label>
              <input v-model="newUser.password_confirmation" type="password" id="password_confirmation" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </template>
      
  <script>
  import { defineComponent, ref } from 'vue';
  import { useRouter } from 'vue-router';
  
  export default defineComponent({
    name: 'CreateUser',
    setup() {
      const newUser = ref({ name: '', email: '', role_id: '', password: '', password_confirmation: '' });
      const errors = ref({});
  
      const router = useRouter();
  
      const BASE_URL = "http://127.0.0.1:8000/api";
  
      const createUser = async () => {
        try {
          // Clear previous errors
          errors.value = {};
          const response = await fetch(`${BASE_URL}/register`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newUser.value),
          });
  
          if (response.ok) {
            const responseData = await response.json();
  
            if (responseData.status === 'success') {
              router.push('/users');
            } else if (responseData.status === 'error') {
              console.log(responseData.errors);
              errors.value = responseData.errors;
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
        newUser,
        errors,
        createUser,
      };
    },
  });
  </script>
      