<template>
  <article class="media">
  <figure class="media-left">
    <p class="image is-64x64">
      <img :src="ImagePath+'/'+userImage" class="avatar is-circle">
    </p>
  </figure>
  <div class="media-content">
    <div class="field">
      <p class="control">
        <textarea v-on:keyup.enter="keyUpEnter()" v-model="form.body" class="textarea" placeholder="Add a comment..."></textarea>
      </p>
    </div>
    <nav class="level">
      <div class="level-left">
        <div class="level-item">
          <a class="button is-info" @click="saveComment()">Comment On Status</a>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <label class="checkbox">
            <input type="checkbox" v-model="enterKey"> Press enter to submit
          </label>
        </div>
      </div>
    </nav>
  </div>
</article>
</template>

<script>
import Form from "./../../../utilities/Form";
import {EventBus} from "./../../../utilities/EventBus"
export default {
      props:['avatar', 'statusid','path'],
mounted(){
    this.userImage= this.avatar
    this.ImagePath = this.path    
    },
data(){
    return{
        userImage:'',
        form: new Form({
            body: '',
        }),
        enterKey: '',
        ImagePath: ''
    }
},
  methods:{
    saveComment(){
        return this.form.post("/post-comment/" + this.statusid).then(response=>(this.AnnounceComment(response)))
    },
    AnnounceComment(response){
        EventBus.$emit('comment-added', response)
    },
    keyUpEnter(){
        if(this.enterKey == true){
            this.saveComment()
        }
    },

}
}
</script>
