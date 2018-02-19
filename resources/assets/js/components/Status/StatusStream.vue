<template>
    <div>
        <div v-for="status in statuses" :key="status.id">
            <div class="box message mb-1" :class="status.mood.color">
                <article class="media message-body">
                    <div class="media-left">
                        <a :href="decorateUsername(status.user.username)">
                            <figure class="image is-65x65">
                                <img class="avatar is-circle" :src="imagePath+status.user.profile_image.path" alt="Image">
                            </figure>
                        </a>
                    </div>
        <div class="media-content">
            <div class="content">
                <p>
                    
                    <strong><a :href="decorateUsername(status.user.username)">{{status.user.first_name}} {{status.user.last_name}}</a></strong> 
                        <small>{{status.user.username}}</small> <small>{{formatDate(status.created_at)}}</small>
                        <br>
                {{status.body}}
                </p>
            </div>
        <nav class="level is-mobile">
            <div class="level-left">
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-reply"></i></span>
                </a>
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                </a>
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-heart"></i></span>
                </a>
            </div>
            <div class="level-right" v-show="isOwnedBy(status.user.id)">
                    <button class="button" @click="deleteStatus(status.id) " type="submit">Delete Status</button>
            </div>
        </nav>
        </div>
    </article>
</div>
      </div>
  </div>
</template>

<script>
import moment from 'moment'
import {EventBus} from './../../utilities/EventBus'
import Form from './../../utilities/Form'
    export default {
        props:['urlpath','currentuserid'],

        mounted(){
            this.getStatus()
            EventBus.$on('status_posted',status=>{
                this.newStatus(status)
            })
        }, 
        data(){
            return{
             form: new Form(),
             statuses:[],
             imagePath: this.urlpath+"/",
             status:''
        }
        },
        methods:{
            newStatus(status){
                this.statuses.unshift(status)
            },
            getStatus(){
                return  axios.get('/get-statuses').then(response=>(this.prepareStatus(response.data.data)))
            },

            prepareStatus(statuses){
                this.statuses = statuses
            },
            isOwnedBy(userID){
                return userID == this.currentuserid
            },
            deleteStatus(statusToBeDeleted){
                if ( confirm("Are you sure you want to delete")){
                    this.form.delete('delete-status/'+statusToBeDeleted).then(response=>this.statusDeleted(response))
                }
            },
            statusDeleted(statusID){
                 this.statuses.splice(statusID, 1);
                 this.getStatus()
                 EventBus.$emit('status_deleted',"deleted")
            },
            formatDate(date){
                var differencesInTime = this.getTimeDifferences(date)
                return this.formatTimeText(differencesInTime, date)
            },

            getTimeDifferences(date){
                var created_at = moment(date).format()
                var timeNow = moment().format()
                var createdInSeconds = moment(created_at);
                var nowInSeconds = moment(timeNow);
                var differencesInTime= nowInSeconds.diff(createdInSeconds, 'seconds')
                return differencesInTime - 3600
            },
            formatTimeText(differencesInTime, date){
                if(differencesInTime <= 10){
                    return "few seconds ago"
                }
                else if(differencesInTime <= 59){
                    return "about a minutes ago"
                }
                else if(differencesInTime <= 600 ){
                    return "few minutes ago"
                }
                else if(differencesInTime <= 2000 ){
                    return "less than an hour ago"
                }
                else if(differencesInTime >= 3600 ){
                    return moment(date).startOf('minutes').fromNow(); 
                }
            },
             decorateUsername(username){
               return "/user/@"+username
            }
        },
    }
</script>
