<template>
    <div class="message ">                            
        <div class="message-body">
            <form action="" method="POST" @submit.prevent>
                <input type="hidden" name="profileID" v-model="profile">
                <textarea class="textarea mb-1" name="body" placeholder="Whats on your mind...?" v-model="formBody" required></textarea> 
                <div class="columns">
                    <div class="file column is-primary is-4"> 
                        <div class="" @click="activateModal()">
                            <label class="file-label">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fa fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Add Picture...
                                        </span>
                                    </span>
                                </label>
                        </div>
                       <picturesupload :token="token"
                           :clicked ="modalActivated"
                           url="/picture-upload">
                       </picturesupload>
                    </div>
                    <div class="column  is-5">
                            <div class="control has-icons-left">
                                    <div class="select">
                                      <select class="is-focused" name="mood" v-model="selectedMood" @change="sendToForm(selectedMood)">
                                            <option default value="0">Select Mood</option>
                                            <option v-for="mood in moods" :key="mood.id" :value="mood.id">{{mood.name}} </option>
                                      </select>
                                    </div>
                                    <span class="icon is-medium is-left">
                                      <i class="fa fa-heart"></i>
                                    </span>
                                  </div>
                    </div>
                    <div class="column">
                        <button type="submit" class="button is-link" @click="onSubmit">Post Status...</button>
                    </div>
                </div>
             </form>
        </div>
    </div>
</template>
<script>
import Form from './../../utilities/Form'
import {EventBus} from './../../utilities/EventBus'
import PicturesUpload from './PicturesUpload'

    export default {
        props:['profileid','posturl','token'],
        components:{
            'picturesupload':PicturesUpload
        },

        mounted(){
            this.getMoods()
            this.listenForEvents()
        }, 
        data(){
            return{
                form: new Form({
                    profileID:'',
                    body: '',
                    mood: '',
                    pictures:[]
                }),
                moods: [],
                selectedMood: 0,
                defaultMood: 1,
                formBody: '',
                profile: '',
                modalActivated:''
            }
        },
        methods:{
            
            onSubmit(){
                this.setUpFormFields()
                this.form.post(this.posturl)
                        .then(response=> this.shout(response.status))
            },
            shout(postedStatus){
                this.resetFormFields()
                EventBus.$emit('status-posted', postedStatus)
            },
            getMoods(){
                return axios.get('/get-moods').then(response =>this.moods=response.data)
            },
            sendToForm(selectedMood){
                this.form.mood = selectedMood
            },
            setUpFormFields(){
                this.form.body = this.formBody
                this.form.profileID = this.profileid
            },
            resetFormFields(){
                this.formBody = '',
                this.selectedMood = 0
            },
            listenForEvents(){
                EventBus.$on('picture-uploaded',ids=>{
                    this.form.pictures = ids
                })  
            },
            activateModal(){
                EventBus.$emit('PictureUploadClicked')
            }
        },
    }
</script>
