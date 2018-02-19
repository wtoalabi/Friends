<template>
<div>
    <span class="" v-for="chunkedColumn in chunkedUsers" :key="chunkedColumn.id">
        <div class="columns">
            <div class="column is-4" v-for="(user, index) in chunkedColumn" :key="user.id">
                 <a :href="linkToUsername(user.username)">                    
                    <img :src="linkToThumb(user.profile_image['path'])" alt="Image" class="image is-64x64 is-circle" > 
                 </a>
                 <a :href="linkToUsername(user.username)">
                    {{user.name}}
                </a> 
                                 
                <followbutton :following="user.id" :isfollowed="isfollowed"></followbutton>
            </div>
    </div>
</span>
</div>
</template>
<script>
import followbutton from '../Users/FollowButton'
import {EventBus} from './../../utilities/EventBus'

    export default {
        props:['following', 'userstofollow','imagepath', 'isfollowed'],
        mounted(){
         this.getAllUsersToFollow()
         EventBus.$on('userFollowed',id=>{
                this.removeUserFromList(id)
         })
         
        },
        components:{
            'followbutton':followbutton
        },    
            data(){
                return{
                     followID: this.following,
                     users: [],
                     chunkedUsers:[],
                     thumbPath: ''
            }
                },
        methods:{
            getAllUsersToFollow(){
                return axios.get('users-to-follow').then(response=>this.getUsers(response.data))          
            },
            getUsers(data){
                this.users = data
                this.thumbPath = this.imagepath
                this.chunkedUsers = _.chunk(data, 3)
            },
            linkToThumb(username){
                return this.thumbPath+"/"+username
            },
            linkToUsername(username){
                return "/user/@"+username
            },
            removeUserFromList(id){
                this.users.splice(id, 1);
                this.getAllUsersToFollow()
            }
            
        },
    }
</script>
