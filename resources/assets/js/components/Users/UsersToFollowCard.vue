<template>
<div>
   <div v-for="groupedUsers in chunkUsers(usersToFollow)" :key="groupedUsers.id">
        <div class="columns">
            <div class="column is-4" v-for="user in groupedUsers" :key="user.id">
                <div class="">
                            <figure class="image is-4by3">
                                <a :href="linkToUsername(user.username)">
                                    <img class="" :src="linkToThumb(user.images)" alt="Image">
                                </a>
                            </figure>
                        <div class="">
                            <div class="media">        
                                <div class="media-content">
                                    <a :href="linkToUsername(user.username)">
                                        <p class="">{{reduceFirstNameCharacters(user.first_name)}}</p>
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                <followbutton :recipientuserid="user.id"></followbutton>
            </div>
        </div>
     </div>
</div>
</template>
<script>
//import followbutton from '../Users/FollowButton'
import {EventBus} from './../../utilities/EventBus'
    export default {
        props:['following','imagepath', 'isfollowed'],
        mounted(){     
        this.getAllUsersToFollow()         
        },
        data(){
            return{
                followID: this.following,
                users:'',
                usersToFollow:''
            }   
        },
        methods:{
            getAllUsersToFollow(){
                return axios.get('/users-to-follow').then(response=>(this.allUsers(response.data))) 
            },
            allUsers(users){                
                this.usersToFollow = users
            },
            chunkUsers(users){
            return _.chunk(users,3);
        },
            linkToThumb(image){
            if(image == 0){
                return this.imagepath+ "/" +"default.jpg"
            }
            else{
                return this.imagepath + "/" +image[0].thumb
            }
        },
            linkToUsername(username){
                return "/user/@"+username
        },
            reduceFirstNameCharacters(name){
                var reducedname = name.substring(0,6)
                    return reducedname + "..."
            }
        }
    }
</script>
