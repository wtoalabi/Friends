<template>
<div>
    <strong><a :href="formatUrl(statusowner.username)"> {{formatFullName(statusowner)}}</a></strong> 
    <small><a class="has-text-black" :href="formatUrl(statusowner.username)">@{{statusowner.username}}</a></small> <small>{{formatTime(time)}}</small>
    <div class="mb-0" v-if="resharedfrom != null">
        <div class="mb-1" v-if="OriginallyPostedBy.id != statusowner.id && statusoriginalid != null">
            <div v-if="OriginallyPostedBy.id == OriginalProfilePostedOn.id">
                <span>Shared by<a class="has-text-info" 
                    :href="decorateUsername(statusowner.username)">
                    {{statusowner.first_name}}</a>
                </span>
                <span>from <a class="has-text-info" 
                    :href="decorateUsername(OriginallyPostedBy.username)">
                    {{decorateName(OriginallyPostedBy.first_name)}}</a> 
                    <a class="has-text-primary" :href="'/'+OriginalStatusSlug"> Wall</a>
                </span>
            </div>
            <div v-else>
                <span>Shared from <a class="has-text-info" 
                    :href="decorateUsername(OriginalProfilePostedOn.username)">
                    {{decorateName(OriginalProfilePostedOn.first_name)}}</a> 
                    <a class="has-text-primary" :href="'/'+OriginalStatusSlug"> Wall</a>
                </span>
                <span>...written by<a class="has-text-info" 
                    :href="decorateUsername(OriginallyPostedBy.username)">
                    {{OriginallyPostedBy.first_name}}</a>
                </span>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import FormatTime from './../../utilities/formatTime'
export default {
    props:['statusowner','time', 'resharedfrom', 'statusoriginalid'],
    mounted(){
        this.getOwners()                          
    }, 
    data(){
        return{
            OriginallyPostedBy: '',
            OriginalProfilePostedOn: '',
            OriginalStatusSlug:''

        }
    },
    methods:{
        getTextFor(sharedFrom, profileOwner){
        },
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
            if(name != null){
            if(name.match(/[s]$/)){
                    return name+"'"
            }
         else{
             return name + "'s"
            }
        }else{
            return
        }
    },
     decorateUsername(username){
        return "/user/@"+username 
         },
    getOwners(){
        if(this.resharedfrom != null){
            this.OriginallyPostedBy = this.resharedfrom.user
            this.OriginalProfilePostedOn = this.resharedfrom.profile_owner
            this.OriginalStatusSlug = this.resharedfrom.slug
        }
    },
}
}
</script>
