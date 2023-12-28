<template>
    <div class="container mt-4">
      <div class="card shadow rounded">
        <div class="card-header">
          <h4 class="d-inline">Add User
            <RouterLink to="/users" class="btn btn-sm btn-outline-success float-end">Users</RouterLink>
          </h4>
        </div>
        <div class="card-body">
          <form @submit.prevent="updateUser">
            <div class="form-group">
              <label for="name">Name:</label>
              <input v-model="userData.name" type="text" id="name" class="form-control" />
              <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input v-model="userData.email" type="email" id="email" class="form-control" />
              <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
            </div>
            <div class="form-group">
              <label for="role_id">Role:</label>
              <input v-model="userData.role_id" type="number" id="role_id"  class="form-control" />
              <span v-if="errors.role_id" class="text-danger">{{ errors.role_id[0] }}</span>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input v-model="userData.password" type="password" id="password" class="form-control" />
              <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
            </div>
            <div class="form-group">
              <label for="password">Password Confirmation:</label>
              <input v-model="userData.password_confirmation" type="password" id="password_confirmation" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </template>

<script>
import { defineComponent } from 'vue';
import { useFetch } from '@vueuse/core';
import { useRouter } from 'vue-router';

export default defineComponent({
  name: 'updateUser',
  setup() {
    const router = useRouter();
    const { id } = router.params;  // Get the ID from the URL

    const BASE_URL = "http://127.0.0.1:8000/api";

    const { data: userData, error: userError, isLoading: userIsLoading } = useFetch(`${BASE_URL}/users/${id}`);

    console.log(userData);
    const updateUser = async () => {
      try {
        // Perform logic to update the user using userData
        // Use fetch or other method to send updated user details to the API
        // ...

        // Redirect to the user details page after update
        router.push(`/users/${id}`);
      } catch (error) {
        console.error('Error updating user:', error);
      }
    };

    return {
      userData,
      userError,
      userIsLoading,
      updateUser,
    };
  },
});
</script>
    