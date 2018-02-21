<template>
  <div class ="modal" :class="clickOpen">
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
</template>

<script>
    import Form from "./../../utilities/Form";
export default {
    props:['clickOpen','statusid'],
    data(){
          return{
              form: new Form({
                  body:'',
              })
          }
      },
    methods:{
        
        hideModal(){
            this.$emit('hideModalBox')
        },
        submit(){
            //console.log(this.statusid)
            this.form.post('post-comment/'+this.statusid).then(response => this.commentPosted(response.data))
        },
        commentPosted(response){
            //this.setStatusID()
            this.hideModal()

        }
  }
}
</script>

