<template>
<div>
    <span class="" v-for="chunkedColumn in chunkedUsers" :key="chunkedColumn.id">
        <div class="columns">
            <div class="column is-4" v-for="user in chunkedColumn" :key="user.id">
                 <a :href="linkToUsername(user.username)">                    
                    <img :src="linkToThumb(user.images)" alt="Image" class="image is-64x64 is-circle" > 
                 </a>
                 <a :href="linkToUsername(user.username)">
                    {{reduceFirstNameCharacters(user.first_name)}}
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
        props:['following','imagepath', 'isfollowed'],
        mounted(){     
         this.getAllUsersToFollow()
         EventBus.$on('user-unfollowed',id=>{
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
                return axios.get('/users-to-follow').then(response=>this.getUsers(response.data))          
            },
            getUsers(data){
                this.users = data
                this.thumbPath = this.imagepath
                this.chunkedUsers = _.chunk(data, 3)
            },
            linkToThumb(image){
                if(image == 0){
                    return this.thumbPath+ "/" +"default.jpg"
                }
                else{
                return this.thumbPath + "/" +image[0].thumb
                }
            },
            linkToUsername(username){
                return "/user/@"+username
            },
            removeUserFromList(id){
                this.users.splice(id, 1);
                this.getAllUsersToFollow()
            },
            reduceFirstNameCharacters(name){
                var reducedname = name.substring(0,6)
                return reducedname + "..."
            }
            
        },
    }
</script>
