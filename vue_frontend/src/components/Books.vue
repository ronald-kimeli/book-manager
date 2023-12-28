
<template>
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Book list</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                 <li class="breadcrumb-item" aria-current="page">Books</li>
              </ol>
            </nav>
          </div>
          <div class="col-3">
            <div class="text-center mb-n5">
              <img src="../assets/images/breadcrumb/rocket.png" alt=""
                class="img-fluid mb-n4" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="product-list">
      <div class="card">
        <div class="card-header ">
          <h4 class="d-inline">
            <RouterLink to="/books/create" class="btn btn-sm btn-dark float-end">Create Book</RouterLink>
          </h4>
        </div>
        <div class="card-body p-3">
        
          <div class="table-responsive border rounded">
            <table class="table align-middle text-nowrap mb-0">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Books</th>
                  <th scope="col">Publisher</th>
                  <th scope="col">Status</th>
                  <th scope="col">Pages</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(book, index) in books" :key="index">
                  <td>
                    <p class="mb-0">{{ book.id }}</p>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img :src="book.image" class="rounded-circle" alt="Book cover" width="56" height="56">
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-0 fs-4">{{ book.name }}</h6>
                        <p class="mb-0">{{ book.category }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0">{{ book.publisher }}</p>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="text-bg-success p-1 rounded-circle" v-if="book.status == 'Available' "></span>
                      <span class="text-bg-danger p-1 rounded-circle" v-else></span>
                      <p class="mb-0 ms-2">{{ book.status }}</p>
                    </div>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">{{ book.pages }}</h6>
                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Third group">
                      <RouterLink :to="`/books/${book.id}`" class="btn btn-sm btn-primary mx-2">Edit</RouterLink>
                      <button @click="deleteBook(book.id)" class="btn btn-sm btn-danger mx-2">Delete</button>
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
  name: 'BookList',
  setup() {
    const books = ref([]);

    const BASE_URL = "http://localhost:8000/api";

    const fetchBooks = async () => {
      try {
        const { data } = await useFetch(`${BASE_URL}/books`);
        const response = data.value;
        const responseData = await response;
        books.value = JSON.parse(responseData).data
        console.log(books.value);
      } catch (error) {
        console.error('Error fetching books:', error);
      }
    };

    const deleteBook = async (bookId) => {
      try {
        //  await useFetch(`${BASE_URL}/books/${bookId}`, { method: 'DELETE' });
         console.log(await useFetch(`${BASE_URL}/books/${bookId}`, { method: 'DELETE' }));
        await fetchBooks();
      } catch (error) {
        console.error('Error deleting user:', error);
      }
    };

    onMounted(() => {
      fetchBooks();
    });

    return {
      books,
      deleteBook,
    };
  },
});
</script>

<style scoped></style>