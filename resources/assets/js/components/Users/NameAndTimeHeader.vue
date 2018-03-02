<template>
<div>
    <strong><a :href="formatUrl(user.username)"> {{formatFullName(user)}}</a></strong> 
    <small><a class="has-text-black" :href="formatUrl(user.username)">@{{user.username}}</a></small> <small>{{formatTime(time)}}</small>
    <div class="mb-1" v-if="profileowner.id != user.id">
        <span >Shared on <a class="has-text-info" :href="decorateUsername(profileowner.username)">{{decorateName(profileowner.first_name)}}</a> Page.</span>
    </div>
</div>
</template>

<script>
    import FormatTime from './../../utilities/formatTime'
export default {
    props:['user','time', 'profileowner'],
    mounted(){
        console.log(this.profileowner);
        
    }, 
    data(){
        return{

        }
    },
    methods:{
        formatUrl(username){
            return '/user/@'+username
        },
        formatFullName(user){
            return user.first_name + ' ' + user.last_name
        },
        formatTime(time){
            return new FormatTime().formatTimeAgo(time)
        },
        decorateName(name){
         if(name.match(/[s]$/)){
             return name+"'"
         }
         else{
             return name + "'s"
         }
    },
     decorateUsername(username){
        return "/user/@"+username
            }
    }
}
</script>
