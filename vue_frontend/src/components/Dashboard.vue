<script setup>
import Sidebar from './Layout/Sidebar.vue';
import Header from './Layout/Header.vue';
import Footer from './Layout/Footer.vue';
</script>

<template>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <Sidebar />
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <Header />
      <!--  Header End -->
      <div class="container-fluid">
        <router-view></router-view>
        <Footer />
      </div>
    </div>
  </div>
</template>
