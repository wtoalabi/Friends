<template>
    <div>
        <commentsbox
            :avatar="avatar"
            :statusid="statusid"
            :path="path">
        </commentsbox> 
        <hr> 
        <div class="mt-3">
            <commentslist
                :statusid="this.statusid" 
                :ImagePath="this.ImagePath">
            </commentslist>
        </div>
    </div>
</template>
<script>

import CommentsList from './CommentsList'
import CommentsBox from './CommentsBox'
export default {
  props:['avatar', 'statusid','path'],
mounted(){
       this.ImagePath = this.path
    },
components:{
    'commentsbox': CommentsBox,
    'commentslist': CommentsList
},
data(){
    return{
        ImagePath: ''
    }
},
methods:{

},
}
</script>
