import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../components/Dashboard.vue";
import Main from "../components/Main.vue";
import Books from "../components/Books.vue";
import UsersIndex from "../components/Users/Index.vue";
import UsersCreate from "../components/Users/Create.vue";
import UserDetails from '../components/Users/[id].vue';
import NotFound from "../components/NotFound.vue";


const routes = [
  {
    path: '/dashboard',
    // redirect: '/dashboard', // Redirect to child1 by default
    component: Dashboard,
    children: [
      {
        path: '/dashboard',
        component: Main
      },
      {
        path: '/books',
        component: Books
      },
      {
        path: '/books:id',
        component: Books
      },
      {
        path: '/users',
        component: UsersIndex
      },
      {
        path: '/users/create',
        component: UsersCreate
      },
      {
        path: '/users/:id',
        name: 'UserDetails',
        component: UserDetails,
      },  
      
    ]
  },
  {
    path: "/",
    name: "Login",
    component: () => import("../components/Auth/Login.vue"),
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
