<script setup>
import {authStore} from "@/stores/authStore.js";
import {ref} from "vue";
const auth=authStore()
const email=ref('')
const password=ref('')


  const login = async ()=>{
   const data = {
     email: email.value,
     password :password.value
   }
   await auth.login(data)
}
</script>
<template>
  <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-body ">
          <section class="row flexbox-container" v-if="! auth.isAuth">
            <div class="col-xl-8 col-11 d-flex justify-content-center">
              <div class="card bg-authentication rounded-0 mb-0">
                <div class="row m-0">
                  <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="../../../app-assets/images/pages/login.png" alt="branding logo">
                  </div>
                  <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                      <div class="card-header pb-1">
                        <div class="card-title">
                          <h4 class="mb-0">Login</h4>
                        </div>
                      </div>
                      <p class="px-2">Welcome back, please login to your account.</p>
                      <form @submit.prevent="login">
                        <div class="card-content">
                          <div class="card-body pt-1">
                            <fieldset class="form-label-group form-group position-relative has-icon-left">
                              <input type="text" v-model="email" class="form-control" id="user-name" placeholder="email" required>
                              <div class="form-control-position">
                                <i class="feather icon-user"></i>
                              </div>
                              <label for="user-name">email</label>
                            </fieldset>

                            <fieldset class="form-label-group position-relative has-icon-left">
                              <input type="password" v-model="password" class="form-control" id="user-password" placeholder="Password" required>
                              <div class="form-control-position">
                                <i class="feather icon-lock"></i>
                              </div>
                              <label for="user-password">Password</label>
                            </fieldset>
                            <div class="form-group d-flex justify-content-between align-items-center">
                              <div class="text-left">
                                <fieldset class="checkbox">
                                  <div class="vs-checkbox-con vs-checkbox-primary">
                                    <input type="checkbox">
                                    <span class="vs-checkbox">
                                      <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                      </span>
                                    </span>
                                  </div>
                                </fieldset>
                              </div>
                            </div>
                            <a href="auth-register.html" class="btn btn-outline-primary float-left btn-inline">Register</a>
                            <button type="submit"  class="btn btn-primary float-right btn-inline">Login</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>
      </div>
    </div>

  <!-- END: Content-->
</template>