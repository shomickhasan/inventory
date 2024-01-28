import axios from "axios";
import {reactive} from "vue";
import router from "@/router/index.js";
import BASE_API from "@/data/baseapi.js";
import {useToast} from 'vue-toast-notification';
const Authstate = reactive({
    isAuthenticate:false,
    email :null,
    password:null,
    async  login(){
        try{
            await axios.post(`${BASE_API}/login-api`,{
                email: this.email,
                password: this.password
            }).then(response => {
                if(response.data.status !="success"){
                    useToast().error('Invalid Creadentials');
                    router.push({name:'login'})
                    localStorage.setItem("token",null)
                    localStorage.setItem("auth",false)
                }
                else{
                    localStorage.setItem("token",response.data.token)
                    localStorage.setItem("auth",true)
                    this.email=null
                    this.password = null
                    useToast().success('Successfully Login');
                    router.push({name:'dashboard'})
                }

            })
        }catch(e) {
            useToast().error(error.message || 'An error occurred');
            router.push({ name: 'login' });
            localStorage.setItem("token",null)
            AuthState.isAuthenticated = false;
            localStorage.setItem("auth",false)
        }
    }
})

export default Authstate