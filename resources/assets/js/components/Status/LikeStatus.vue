<template>
<div>
    <div class="control">
        <div class="tags has-addons" @click="processClick(statusid)">
            <span class="tag">{{likesCount}}</span>
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
    props:['statusid', 'count','currentuser'],
    mounted(){
        this.likesCount = this.count
          this.checkLikeStatus(this.currentuser,this.statusid)  
        },
    data(){
        return{
            LikeText:'',
            statusID: '',
            LikeClass: '',
            likesCount: ''

        }
    },
    methods:{
        processClick(id){
            this.statusID = id
            return axios.post('/like-status/'+this.statusID).then(response=> this.setResponse(response.data.status))
        },

        setResponse(response){
            if(response == 200){
                this.liked()
                this.likesCount ++
                EventBus.$emit('status-liked')
                }
                if(response == 300){
                    this.unLiked()
                    this.likesCount --
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
        checkLikeStatus(user,status){
            return axios.get("/like-status/"+user+"/"+status).then(response=>this.mountLikes(response.data))
        },
        mountLikes(likeStatus){
            if(likeStatus == 1){
                this.liked()
            }
            else if(likeStatus ==0){
                this.unLiked()
            }
        }
}
}
</script>
