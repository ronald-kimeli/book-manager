<template>
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Users list</h4>
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
            <RouterLink to="/users/create" class="btn btn-sm btn-dark float-end">Create User</RouterLink>
          </h4>
        </div>
        <div class="card-body">
          <div class="table-responsive-md table-responsive-xl table-responsive-xxl">
            <table class="table table-striped table-bordered rounded">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Password</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(user, index) in users" :key="index">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.role_id }}</td>
                  <td>{{ user.email }}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Third group">
                      <RouterLink :to="`/users/${user.id}`" class="btn btn-sm btn-primary mx-2">Edit</RouterLink>
                      <button @click="deleteUser(user.id)" class="btn btn-sm btn-danger mx-2">Delete</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { defineComponent, ref, onMounted } from 'vue';
import { useFetch } from '@vueuse/core';


export default defineComponent({
  name: 'UserList',
  setup() {
    const users = ref({ user_id: '', name: '', email: '' });

    const BASE_URL = "http://localhost:8000/api";

    const fetchUsers = async () => {
      try {
        const { data } = await useFetch(`${BASE_URL}/users`);
        const response = data.value;
        const responseData = await response;
        users.value = JSON.parse(responseData).data
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    };

    const deleteUser = async (userId) => {
      try {
        //  await useFetch(`${BASE_URL}/users/${userId}`, { method: 'DELETE' });
        console.log(await useFetch(`${BASE_URL}/users/${userId}`, { method: 'DELETE' }));
        await fetchUsers();
      } catch (error) {
        console.error('Error deleting user:', error);
      }
    };

    onMounted(() => {
      fetchUsers();
    });

    return {
      users,
      deleteUser,
    };
  },
});
</script>