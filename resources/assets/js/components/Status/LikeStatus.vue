<template>
<div>
    <div class="control">
        <div class="tags has-addons" @click="processClick(statusid)">
            <span class="tag">{{count}}</span>
            <a class="tag mr-1" :class="LikeClass" :title="LikeText">
                <i class="fa fa-heart"></i>
            </a>
        </div>
    </div>
</div>
</template>
<script>
import {EventBus} from './../../utilities/EventBus'
export default {
    props:['statusid','currentuser'],
    mounted(){        
        this.getLikeStatus(this.currentuser,this.statusid)
        },
    data(){
        return{
            LikeText:'',
            statusID: '',
            LikeClass: '',
            count:''

        }
    },
    methods:{
        processClick(id){
            this.statusID = id
            return axios.post('/like-status/'+this.statusID).then(response=> this.setResponse(response.data))
        },

        setResponse(response){
            this.count = response.total            
            if(response.status == 200){
                this.liked()
                EventBus.$emit('status-liked')
                }
                if(response.status == 300){
                    this.unLiked()
                    EventBus.$emit('status-unLiked')
                }
            },
        
        liked(){
          this.LikeText = "Unlike Status"  
          this.LikeClass = "is-danger"
        },
        unLiked(){
            this.LikeText = "Click to Like!"
            this.LikeClass = "is-primary"
        },
        getLikeStatus(user,status){            
            return axios.get("/like-status/"+user+"/"+status).then(response=>this.mountLikes(response.data))
        },
        mountLikes(response){
            this.count = response.total
            if(response.status == 1){
                this.liked()
            }
            else if(response.status ==0){
                this.unLiked()
            }
        },
        getCount(){
            return axios.get('/counts/likes/'+this.statusid).then(response=>(this.count=response.data))
        }
}
}
</script>
