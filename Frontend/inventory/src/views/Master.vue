<script setup>
import Header from "@/components/Header.vue";
import Nav from "@/components/Nav.vue";
import Footer from "@/components/Footer.vue";
import { ref } from "vue";
import {authStore} from "@/stores/authStore.js";
const auth = authStore()

// Use ref for simple values
const checkAuth = ref(localStorage.getItem("auth") === "true");

// Handle the case when the value is null or not set
if (checkAuth.value === null) {
  // You might want to set a default value or handle it based on your app's logic
  checkAuth.value = false;
}
</script>

<template>
  <div>
    <!-- BEGIN: Header -->
    <template v-if="auth.isAuth">
      <Header />
    </template>
    <!-- END: Header -->

    <RouterView></RouterView>

    <!-- BEGIN: Main Menu -->
    <template v-if="auth.isAuth">
      <Nav />
    </template>
    <!-- END: Main Menu -->

    <!-- BEGIN: Content -->
    <template v-if="auth.isAuth">
      <Footer />
    </template>
    <!-- END: Footer -->
  </div>
</template>
