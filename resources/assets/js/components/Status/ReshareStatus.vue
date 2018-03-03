<template>
    <div>
        <div class="modal" :class="modalStatus">
            <div class="modal-background" @click="closeModal"></div>
                <div class="modal-card">
                    <article class="message is-medium">
                        <div class="message-header">
                            <p>Reshare {{decorateName(status.user.first_name)}} Status?</p>
                            <button class="delete" aria-label="delete" @click="closeModal"></button>
                        </div>
                        <div class="message-body">
                            <textarea class="textarea mb-2" v-model="form.comment" placeholder="Add Your Thoughts...?"></textarea>
                            <span class="title is-6 has-text-centered"><blockquote><em>{{decorateBody(status.body)}}</em></blockquote></span>
                            <div class="mt-2 columns">
                                <div class="column">
                                <button class="button is-warning" @click.prevent="shared">Reshare...</button>
                                </div>
                                <div class="column is-2">
                                <button class="button" @click="closeModal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
    <div class="control">
        <div class="tags has-addons">
            <span class="tag">{{count}}</span>
            <a class="tag is-warning mr-1" @click="clicked">
                <i class="fa fa-retweet"></i>
            </a>
        </div>
    </div>
</div>
</template>
<script>
import Form from "./../../utilities/Form"
import {EventBus} from "./../../utilities/EventBus";
export default {
  props:['status'],
  mounted(){
      this.getCount()
  },
  data(){
      return{
          modalStatus: '',
          form: new Form({
              comment: '',
          }),
          count: ''
      }

  },

  methods:{
      clicked(){
          this.modalStatus = 'is-active'
      },
      shared(){
          return this.form.post('/reshare/'+this.status.id).then(response=>(this.statusShared(response)))
      },
      statusShared(response){
          this.getCount()
          this.closeModal()
          EventBus.$emit('status-shared', response)
          this.reShareCount ++
      },
      closeModal(){
          this.modalStatus = null
      },
      decorateName(name){
         if(name.match(/[s]$/)){
             return name+"'"
         }
         else{
             return name + "'s"
         }
      },
      decorateBody(body){
          var body = body.substring(0,50)
          return body + "..."

      },
  getCount(){
      return axios.get('/counts/reshares/'+this.status.id).then(response=>(this.count = response.data))
  }
  }

}
</script>
