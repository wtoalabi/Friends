<template>
    <div>
        <div v-if="loading">
            <spinner
                size="small">
            </spinner>
        </div>
        <div v-else>
            <button :class="stateClass" type="submit" @click="onSubmit()">{{buttonText}}</button>
        </div>
    </div>
</template>

<script>
import Form from '../../utilities/Form';
import {EventBus} from './../../utilities/EventBus'
import Spinner from 'vue-simple-spinner'
    export default {
        props:['recipientuserid'],
           mounted() {   
               this.getStatus()                           
        },
        components:{
            'spinner':Spinner
        },
            data(){
                return{
                    form: new Form({
                        follow_id: this.recipientuserid
                    }),
                    followingState: '',
                    buttonText: '',
                    isFollowing:'',
                    stateClass:'',
                    loading: ''
                }
            },
        methods:{
            onSubmit(){                
                return axios.post('/following/' +this.recipientuserid)
                    .then(response=>this.submitted(response.data.status))

            },
            followed(){
                this.isFollowing = true
                this.buttonText = "Unfollow"
                this.stateClass = "button is-danger"
            },
            unfollowed(){
                this.isFollowing = false
                this.buttonText = "Follow"
                this.stateClass = "button is-primary"
            },
            submitted(response){
                if(response == 200){
                    this.followed()
                    EventBus.$emit("user-followed");
                }
                     else if(response ==300){
                         this.unfollowed()

                    EventBus.$emit("user-unfollowed")};
                },
            getStatus(){
                this.loading = true
                return axios.get('/get-follow-status/'+this.recipientuserid).then(response=>(this.setStatus(response.data.status)))
            },
            setStatus(response){
                this.loading= false
                if(response == true){
                   this.followed()
               }
               else if(response == false){
                   this.unfollowed()
               }
            }
            }
    }
</script>
