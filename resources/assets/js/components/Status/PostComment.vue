<template>
    <div>
        <div class="control">
            <div class="tags has-addons" @click="openCommentBox">
                <span class="tag">{{count}}</span>
                    <a class="tag mr-1 is-info" title="LikeText">
                        <i class="fa fa-reply"></i>
                    </a>
            </div>
        </div>
  <div class ="modal" :class="activateCommentBox">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Post A Comment</p>
      <button class="delete" aria-label="close" @click="hideModal"></button>
    </header>
    <section class="modal-card-body">
      <form method="post" @submit.prevent>
        <div class="field">
            <div class="control">
                <textarea class="textarea" name="body" v-model="form.body" placeholder="Post a Comment..." required></textarea>
            </div>
    </div>
    <div class="control">
    </div>
</form>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" @click="submit">Submit...</button>
      <button class="button" @click="hideModal">Cancel</button>
    </footer>
  </div>
</div>
</div>
</template>

<script>
    import Form from "./../../utilities/Form";
    import {EventBus} from './../../utilities/EventBus'
export default {
    props:['statusid', 'count'],
    data(){
          return{
              activateCommentBox: '',
              form: new Form({
                  body:'',
              })
          }
      },
    methods:{
         openCommentBox(){
                this.activateCommentBox = 'is-active'
            },
        hideModal(){
            this.activateCommentBox = false
        },
        submit(){
            this.form.post('post-comment/'+this.statusid).then(response => this.commentPosted(response.data))
        },
        commentPosted(response){
            //this.setStatusID()
            this.hideModal()
            EventBus.$emit('reply-added')

        }
  }
}
</script>

