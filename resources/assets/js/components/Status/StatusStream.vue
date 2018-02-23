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
               <div class="field is-grouped is-grouped-multiline">
                    <postcomment :count="status.comments_count" :statusid="status.id"></postcomment>
                    <likestatus :statusid="status.id" :count="status.likes_count" :currentuser="currentuserid" ></likestatus>
                    <resharestatus :count="status.reshares_count" :status="status"></resharestatus>
                    </div>
                </div>
            <div class="level-right" v-show="isOwnedBy(status.user.id)">
                    <button class="button" @click="deleteStatus(status.id) " type="submit">Delete Status</button>
            </div>
        </nav>
        </div>
    </article>
    </div>
    </div>
<nav v-show="paginate" class="pagination is-rounded" role="navigation" aria-label="pagination">
  <a class="pagination-previous" :disabled="onFirstPage" @click="loadPreviousPage">Previous Set of Statuses</a>
  <a class="pagination-next" :disabled="onLastPage" @click.prevent="loadNextPage">Next Set of Statuses</a>
</nav>
  </div>
</template>

<script>
import moment from 'moment'
import {EventBus} from './../../utilities/EventBus'
import Form from './../../utilities/Form'
import postcomment  from "./PostComment";
import likestatus  from "./LikeStatus";
import resharestatus  from "./ReshareStatus";
    export default {
        props:['urlpath','currentuserid',],
        components:{
            'postcomment': postcomment,
            'likestatus': likestatus,
            'resharestatus': resharestatus,
        },
        mounted(){
            this.stream = '/stream'
            this.getStatus()
            this.listenForEvents()
        }, 
        data(){
            return{
             form: new Form(),
             statuses:[],
             imagePath: this.urlpath+"/",
             status:'',
             nextPage:'',
             previousPage:'',
             onFirstPage: '',
             stream:'',
             onLastPage: null,
             paginate: null
        }
        },
        methods:{
            newStatus(status){
                this.statuses.unshift(status)
                this.getStatus()
            },
            getStatus(){
                return  axios.get(this.stream).then(response=>(this.prepareStatus(response.data)))
            },

            prepareStatus(statuses){
                if(statuses.from != statuses.last_page && statuses.from != null)
              {
                  this.paginate = true
                  this.setPagination(statuses)
              }                   
                this.statuses = statuses.data
            },
            isOwnedBy(userID){
                return userID == this.currentuserid
            },
            deleteStatus(statusToBeDeleted){
                if ( confirm("Are you sure you want to delete")){
                    this.form.delete('/delete-status/'+statusToBeDeleted).then(response=>this.statusDeleted(response))
                }
            },
            statusDeleted(statusID){
                 this.statuses.splice(statusID, 1);
                 this.getStatus()
                 EventBus.$emit('status_deleted',"deleted")
            },
            setPagination(data){
                //console.log("?page="+data.current_page)
                this.stream = "/stream/?page="+data.current_page
                this.previousPage = data.prev_page_url
                this.nextPage = data.next_page_url
                this.disableButtons(data.from, data.to, data.total)
            },
            loadNextPage(){
                return  axios.get(this.nextPage).then(response=>(this.prepareStatus(response.data)))

            },
            loadPreviousPage(){
                return  axios.get(this.previousPage).then(response=>(this.prepareStatus(response.data)))
            },
            disableButtons(from, to, total){
                 if(from == 1){
                    this.onFirstPage = true
                }
                else{
                    this.onFirstPage = false
                }
                if(to == total){                    
                    this.onLastPage = true
                }
                else{
                    this.onLastPage = false
                }
            },
            listenForEvents(){
                EventBus.$on('status_posted',status=>{
                    this.newStatus(status)
                    })
                EventBus.$on('status-liked',liked=>{this.getStatus()})
                EventBus.$on('status-unLiked',liked=>{this.getStatus()})
                EventBus.$on('reply-added',reply=>{this.getStatus()})
                EventBus.$on('status-shared',shared=>{this.getStatus()})

                EventBus.$on("user_unfollowed", unfollowed=> {this.getStatus()})
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
