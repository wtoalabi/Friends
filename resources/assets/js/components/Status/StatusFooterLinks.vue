<template>
    <div>
        <nav class="level is-mobile">
            <div class="level-left">
               <div class="field is-grouped is-grouped-multiline" @click.prevent.self>
                    <postcomment :propcount="status.comments_count" 
                                 :statusid="status.id">
                                 </postcomment>
                    <likestatus :statusid="status.id" :currentuser="currentuserid" ></likestatus>
                    <resharestatus :propcount="status.reshares_count" :status="status"></resharestatus>
                </div>
                </div>
            <div class="level-right is-hidden-mobile" v-show="isOwnedBy(status.user.id)">
                <button class="button" :class="deleting" @click.prevent.self @click="deleteStatus(status.id) " type="submit">Delete Status</button>
            </div>
        </nav>
    </div>
</template>

<script>
import postcomment  from "./PostComment";
import likestatus  from "./LikeStatus";
import resharestatus  from "./ReshareStatus";
import { EventBus } from "./../../utilities/EventBus";
import Form from "./../../utilities/Form";
export default {
    props:['status', 'currentuserid'],
    components:{
        'postcomment':postcomment,
        'likestatus': likestatus,
        'resharestatus': resharestatus
  },
    data(){
        return{
            form: new Form(),
            deleting: ''
        }
    },
    methods:{
        deleteStatus(statusToBeDeleted){
            if ( confirm("Are you sure you want to delete")){
                this.deleting = 'is-loading'
                this.form.delete('/delete-status/'+statusToBeDeleted).then(response=>this.statusDeleted(response))
            }
        },
       statusDeleted(statusID){
           EventBus.$emit('status-deleted',"deleted")
            this.deleting = ''
            },
        isOwnedBy(userID){
            return userID == this.currentuserid
        },
    }
}
</script>