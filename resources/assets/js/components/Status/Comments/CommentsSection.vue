<template>
    <div>
        <h1 class="title is-5">{{format(commentsCount)}}</h1>
        <hr>
        <commentsbox
            :avatar="avatar"
            :statusid="statusid"
            :path="path">
        </commentsbox> 
        <hr> 
        <div class="mt-3">
            <commentslist
                :statusid="this.statusid" 
                :ImagePath="this.ImagePath"
                :currentuser="this.currentuser">
            </commentslist>
        </div>
    </div>
</template>
<script>

import CommentsList from './CommentsList'
import CommentsBox from './CommentsBox'
import {EventBus} from './../../../utilities/EventBus'
export default {
  props:['avatar', 'statusid','path','commentscount','currentuser'],
mounted(){
       this.ImagePath = this.path
       this.commentsCount = this.commentscount
       this.listenForEvents()
    },
components:{
    'commentsbox': CommentsBox,
    'commentslist': CommentsList,
},
data(){
    return{
        ImagePath: '',
        commentsCount: ''
    }
},
methods:{
    format(count){
        if(count ==0){
            return "There are no comments yet...Add one!"
        }
        else if(count == 1){
            return "1 Comment"
    }
    return count + " Comments"
},
listenForEvents(){
    EventBus.$on('comment-added', comment=>{this.increaseCount(comment)})
    EventBus.$on('comment-deleted', comment=>{this.decreaseCount(comment)})
},
increaseCount(){
    this.commentsCount ++
},
decreaseCount(){
    this.commentsCount --
    }
}
}
</script>
