// store/AuthStore.js
import { defineStore } from 'pinia';
import axios from 'axios';
import {reactive} from "vue";
import { toRefs } from 'vue';
import router from "@/router/index.js";
import {useToast} from "vue-toast-notification";


export const authStore =defineStore('auth',()=>{
    const state = reactive({
        token: null,
        userName: null,
        isAuth: false,
    });

    const storedToken = localStorage.getItem('authToken');
    if (storedToken) {
        state.token = storedToken;
        state.isAuth = true;
    }

    async function login(creadentials){
          try{
              const response = await axios.post('http://localhost:8000/api/login-api',
                  creadentials
              ).then(response =>{
                      if(response.data.status==="success"){
                          state.isAuth= true
                          state.token= response.data.token
                          // Save the token to browser storage
                          localStorage.setItem('authToken', state.token);
                          useToast().success('Successfully Login');
                          router.push({name:'dashboard'})
                      }
                      else{
                          useToast().error('creadential mitchmatch');
                          router.push({name:'login'})
                      }
              })

          } catch(e){
              console.log('login error',e)
              if (error.response) {
                  console.error('Server responded with an error:', error.response.status, error.response.data);
              } else if (error.request) {
                  console.error('No response received from the server');
              } else {
                  console.error('Error setting up the request:', error.message);
              }
          }



    }
    function logout() {
        // Clear state and remove token from browser storage
        state.token = null;
        state.userName = null;
        state.isAuth = false;
        localStorage.removeItem('authToken');
        useToast().success('Successfully Logout');
        router.push({name:'login'})
    }


    return { ...toRefs(state), login,logout };
})
