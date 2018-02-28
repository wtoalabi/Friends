<template>
<div>
    <strong><a :href="formatUrl(user.username)"> {{formatFullName(user)}}</a></strong> 
    <small><a class="has-text-black" :href="formatUrl(user.username)">@{{user.username}}</a></small> <small>{{formatTime(time)}}</small>
</div>
</template>

<script>
    import FormatTime from './../../utilities/formatTime'
export default {
    props:['user','time'],
    mounted(){
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
        }
    }
}
</script>
