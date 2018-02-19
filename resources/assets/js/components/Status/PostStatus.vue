<template>
    <div class="message ">                            
        <div class="message-body">
            <form action="" method="POST" @submit.prevent="onSubmit">
                <input type="hidden" name="profileID" v-model="profile">
                <textarea class="textarea mb-1" name="body" placeholder="Whats on your mind...?" v-model="formBody" required></textarea> 
                <div class="columns">
                    <div class="file column is-primary  is-4">
                        <label class="file-label">
                            <input class="file-input" type="file" name="image">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                <span class="file-label">
                                    Upload Picture...
                                </span>
                            </span>
                        </label>
                    </div>
                    <div class="column  is-5">
                            <div class="control has-icons-left">
                                    <div class="select">
                                      <select class="is-focused" name="mood" v-model="selectedMood" @change="sendToForm(selectedMood)">
                                            <option default value="0">Select Your Mood</option>
                                            <option v-for="mood in moods" :key="mood.id" :value="mood.id">{{mood.name}} </option>
                                      </select>
                                    </div>
                                    <span class="icon is-medium is-left">
                                      <i class="fa fa-heart"></i>
                                    </span>
                                  </div>
                    </div>
                    <div class="column">
                        <button type="submit" class="button is-link">Post Status...</button>
                    </div>
                </div>
    </form>
</div>
    
</div>
</template>
<script>
import Form from './../../utilities/Form'
import {EventBus} from './../../utilities/EventBus'
    export default {
        props:['profileid','posturl'],

        mounted(){
            this.getMoods()
            
        }, 
        data(){
            return{
                form: new Form({
                    profileID:'',
                    body: '',
                    mood: ''
                }),
                moods: [],
                selectedMood: 0,
                defaultMood: 1,
                formBody: '',
                profile: ''
            }
        },
        methods:{
            onSubmit(){
                this.setUpFormFields()
                this.form.post(this.posturl)
                        .then(response=> this.shout(response.status))
            },
            shout(postedStatus){
                console.log(postedStatus)
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
            }
           
        },
    }
</script>
