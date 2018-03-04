<template>
    <div>
        <button :class="stateClass" type="submit" @click="onSubmit()">{{buttonText}}</button>
    </div>
</template>

<script>
import Form from '../../utilities/Form';
import {EventBus} from './../../utilities/EventBus'

    export default {
        props:['recipientuserid'],
           mounted() {   
               this.getStatus()                           
        },
            data(){
                return{
                    form: new Form({
                        follow_id: this.recipientuserid
                    }),
                    followingState: '',
                    buttonText: '',
                    isFollowing:'',
                    stateClass:''
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
                return axios.get('/get-follow-status/'+this.recipientuserid).then(response=>(this.setStatus(response.data.status)))
            },
            setStatus(response){
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
