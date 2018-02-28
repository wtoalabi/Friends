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
                <nameandtimeheader :user="comment.user" :time="comment.created_at"></nameandtimeheader>
                {{comment.body}}
            <br>
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
export default {
     name: 'singlecomment',
    props:['ImagePath','comment', 'statusid'],
    components:{
        'replytocomment': ReplyToComment,
        'singlecomment': SingleComment,
        'nameandtimeheader': NameAndTimeHeader
    },
  mounted(){

  },
  data(){
      return{

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
        }
  }
}
</script>
