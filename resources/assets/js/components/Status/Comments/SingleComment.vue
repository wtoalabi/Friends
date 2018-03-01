<template>
<div>
    <article class="media">
        <figure class="media-left">
            <p class="image is-64x64 is-circle avatar">
               <a :href="formatUrl(comment.user.username)"> <img class="is-circle avatar" :src="ImagePath + '/'+ prepareAvatar(comment.user)" alt=""></a>
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <div class="columns">
                    <span class="column">
                        <nameandtimeheader :user="comment.user" :time="comment.created_at"></nameandtimeheader>
                    </span>
                <span class="column is-2" v-if="isOwner">
                    <button class="button is-danger" @click="onDelete">Delete</button>
                </span>
                </div>
                    {{comment.body}}
  </div>
  </div>
</article>
<article class="media">
</article>

  </div>
</template>

<script>
import ReplyToComment from './ReplyToComment'
import SingleComment from './SingleComment'
import NameAndTimeHeader from './../../Users/NameAndTimeHeader'
import { EventBus } from '../../../utilities/EventBus';
export default {
     name: 'singlecomment',
    props:['ImagePath','comment', 'statusid','currentuser'],
    components:{
        'replytocomment': ReplyToComment,
        'singlecomment': SingleComment,
        'nameandtimeheader': NameAndTimeHeader
    },
  mounted(){
      this.checkOwner()
  },
  data(){
      return{
          isOwner: false

      }
  },
  methods:{
    prepareAvatar(user){
        let image = user.images[0]
        if(image){
            return image.thumb
            }
        else{
        return "default.jpg"
        }
    },
    formatUrl(username){
            return '/user/@'+username
        },
  checkOwner(){
      if(this.currentuser == this.comment.user.id){
          return this.isOwner = true
      }
    },
    onDelete(status, comment){
        if(confirm("Are you sure?")){
            return axios.delete('/delete-comment/'+this.statusid+'/'+this.comment.id).then(response=>(this.commentDeleted(response)))
        }
    },
    commentDeleted(response){
            EventBus.$emit('comment-deleted', response)
        }
    }
}
</script>
