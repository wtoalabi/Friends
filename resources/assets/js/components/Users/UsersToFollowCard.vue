<template>
<div>
    <usercard 
        :usersdata="usersToFollow"
        :imagepath="imagepath">
    </usercard>
    <!-- <followbutton :following="user.id" :isfollowed="isfollowed"></followbutton> -->
</div>
</template>
<script>
//import followbutton from '../Users/FollowButton'
import UserCard from './UserCard'
import {EventBus} from './../../utilities/EventBus'
    export default {
        props:['following','imagepath', 'isfollowed'],
        mounted(){     
        this.getAllUsersToFollow()         
         
         EventBus.$on('user-unfollowed',id=>{
             this.removeUserFromList(id)
         })
         
        },
        components:{
            /*  'followbutton':followbutton, */
            'usercard': UserCard
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
            
            removeUserFromList(id){
                this.users.splice(id, 1);
                this.getAllUsersToFollow()
            }
        }
    }
</script>
