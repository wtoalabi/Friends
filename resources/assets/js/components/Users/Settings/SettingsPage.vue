<template>
    <div class="columns">
        <div class="column is-6 is-offset-3 content">
            <spinner v-if="isLoading"
                size="massive">
            </spinner>
            <div v-if="isLoaded">
            <span class="has-text-primary">
                Double click on your information to change them...
            </span>
                <table>
                    <thead>
                        <tr>
                            <th>Email:</th>
                            <th>
                                <span @dblclick="dbClicked('email')">
                                    <div class="columns">
                                        <div class="column is-11" v-if="inputBox == 'email'">
                                            <div class="columns">
                                                <div class="column is-11">
                                                    <input class="input" :class="{'is-danger':form.errors.has('email')}" @keyup.enter="submitInput()"  type="text" v-model="form.email">
                                                    <span class="help is-danger" v-if="form.errors.has('email')">{{form.errors.get('email')}}</span>
                                                </div>
                                            <div class="column is-1">
                                                <span @click="submitInput()" class="icon has-text-success"><i class="fa fa-check"></i></span>                        
                                            </div>
                                        </div></div>
                                        <div v-else class="column">{{form.email}}
                                        </div>
                                    </div>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                First Name:
                            </td>
                            <td>
                                <span @dblclick="dbClicked('first_name')">
                                    <div v-if="inputBox == 'first_name'">
                                        <div class="columns">
                                            <div class="column is-12">
                                                <div class="columns">
                                                    <div class="column is-10">    
                                                        <input class="input" @keyup.enter="submitInput()"  type="text" v-model="form.first_name">
                                                        <span class="help is-danger" v-if="form.errors.has('email')">{{form.errors.get('email')}}</span>
                                                    </div>
                                                    <div class="column is-2">
                                                        <span @click="submitInput()" class="icon has-text-success"><i class="fa fa-check"></i></span>                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span v-else>{{form.first_name}}</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Last Name:
                            </td>
                            <td>
                                <span @dblclick="dbClicked('last_name')">
                                    <div v-if="inputBox == 'last_name'">
                                        <div class="columns">
                                            <div class="column is-12">
                                                <div class="columns">
                                                    <div class="column is-10">    
                                                        <input class="input" @keyup.enter="submitInput()"  type="text" v-model="form.last_name">
                                                        <span class="help is-danger" v-if="form.errors.has('email')">{{form.errors.get('email')}}</span>
                                                    </div>
                                                    <div class="column is-2">
                                                        <span @click="submitInput()" class="icon has-text-success"><i class="fa fa-check"></i></span>                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span v-else>{{form.last_name}}</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><em><button class="button is-primary" disabled title="You cant change your username"> {{username}}</button></em></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
</template>

<script>
import Form from "./../../../utilities/Form"
import Spinner from "vue-simple-spinner"
import { EventBus } from '../../../utilities/EventBus';
export default {
    props:['loggedinuserid',],
    mounted(){        
        this.getUser()        
    },
    components:{
        'spinner': Spinner
    },
    data(){
        return{
            form: new Form(), 
            inputBox:'',
            username:'',
            isLoading: '',
            isLoaded: false
        }
    },
    methods:{
        getUser(){
            this.isLoading = true
            return axios.get('/get-user/'+this.loggedinuserid).then(response=>(this.prepareUser(response.data)))
        },
        prepareUser(response){
            this.username = response.username
            this.form= new Form({
               email: response.email,
               first_name: response.first_name,
               last_name: response.last_name,
            })
            this.isLoading = false
            this.isLoaded = true
        },
        dbClicked(field){
            this.inputBox = field            
        },
        submitInput(){            
            return this.form.post('/user/update-settings/'+this.username).then(response=>(this.infoChanged(response)))            
        },
        infoChanged(response){
            this.prepareUser(response.user)
            this.inputBox = ''
            EventBus.$emit("UserInfoChanged")
            
        }
    },

}
</script>
