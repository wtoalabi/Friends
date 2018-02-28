<template>
    <div>
        <div>
            <br>
          <span class="icon is-small"><i class="fa fa-reply"></i></span>
            <a @click="replyToComment()">Click to Reply</a>
        </div>
        <div v-if="repliedClicked">
            <div class="columns">
                <div class="column is-11">
                    <article class="media">
                        <div class="media-content">
                            <div class="field">
                            <p class="control">
                                <textarea v-on:keyup.enter="keyUpEnter()" 
                                    class="textarea" 
                                    :placeholder="peopleInConversation()" 
                                    v-model="form.body">
                                </textarea>
                            </p>
                            </div>
                            <nav class="level">
                            <div class="level-left">
                                <div class="level-item">
                                <a class="button is-info" @click="saveComment()">Submit</a>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                <label class="checkbox">
                                    <input v-model="enterKey" type="checkbox"> Press enter to submit
                                </label>
                                </div>
                            </div>
                            </nav>
                        </div>
                    </article>
                </div>
                <div class="column">
                    <a @click="hideReplyBox" class="delete is-large"></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from './../../../utilities/Form'
import {EventBus} from './../../../utilities/EventBus'
export default {
    props:['commentdata','status',''],
  mounted(){  
      //console.log(this.commentData)
      this.comment = this.commentdata
  },
  components:{
      //'commentsreplies': CommentsReplies
  },
  data(){
      return{
          repliedClicked: false,
          enterKey:'',
          form: new Form({
              parentID: this.commentdata.id,
              body:'',
              usersInConversation: []
          }),
          comment: ''
      }
  },
  methods:{
      replyToComment(){
          this.repliedClicked = true
      },
      hideReplyBox(){
          this.repliedClicked = false
      },
      saveComment(){
          return this.form.post('/post-comment/' + this.status).then(response=>{this.shout(response)})
      },
      shout(comment){
          EventBus.$emit('reply-posted', comment)
    },
      keyUpEnter(){
          if(this.enterKey == true){
            this.saveComment()
        }
      },
      peopleInConversation(){
          return "Reply to " +'@'+this.comment.user.username + '\'' +'s comment'
          
      },
  }
}
</script>

