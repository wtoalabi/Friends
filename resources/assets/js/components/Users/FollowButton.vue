<template>
    <div>
<form class="form" method="post" @submit.prevent="onSubmit">
<input class="hidden" v-model="form.follow_id" name="follow_id" type="hidden">

<button :class="stateClass" type="submit" @click="toggleChanges(form.follow_id)">{{buttonText}}</button>
</form>
</div>
</template>

<script>
import Form from '../../utilities/Form';
import {EventBus} from './../../utilities/EventBus'

    export default {
        props:['following', 'isfollowed'],
           mounted() {
               this.setUp()
               if(this.isFollowing == true){
                   this.followed()
               }else if(this.isFollowing == false){
                   this.unFollowed()
               }
        },
            data(){
                return{
                    form: new Form({
                        follow_id: this.following
                    }),
                    followingState: '',
                    buttonText: '',
                    isFollowing:'',
                    stateClass:''
                }
            },
        methods:{
            onSubmit(){
                this.form.post('/following')
                .then(response=>this.submitted(response))

            },
            toggleChanges(data){
                if(this.isFollowing ==true){
                    this.unFollowed(data)
                }
                else if(this.isFollowing == false){
                    this.followed(data)
                }
            },
            followed(id){
                this.isFollowing = true
                this.buttonText = "Unfollow"
                this.stateClass = "button is-danger"
            },
            unFollowed(id){
                this.isFollowing = false
                this.buttonText = "Follow"
                this.stateClass = "button is-primary"
            },
            submitted(response){
                },

            setUp(){
                this.isFollowing =  this.isfollowed;
            }
        }
    }
</script>
