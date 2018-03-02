<template>
    <div>
        <div v-for="status in statuses" :key="status.id">
            <div class="box message mb-1" :class="status.mood.color">
            <a :href="'/'+status.slug" @click.self.prevent>
                <article class="media message-body">
                    <div class="media-left">
                        <a :href="decorateUsername(status.user.username)">
                            <figure class="image is-65x65">
                                <img class="avatar is-circle" :src="imagePath + imageIfExisting(status.user.images)" alt="Image">
                            </figure>
                        </a>
                    </div>
        <div class="media-content">
            <div class="content">          
                <nameandtimeheader :user="status.user" 
                        :time="status.created_at"
                        :profileowner="status.profile_owner">
                </nameandtimeheader>
                    {{status.body}}
                <imagegallery 
                    :images="status.status_images"
                    :path="imagePath"
                    :lightbox="false">
                </imagegallery>
            </div>
        <nav class="level is-mobile">
            <div class="level-left">
               <div class="field is-grouped is-grouped-multiline" @click.prevent.self>
                    <postcomment :count="status.comments_count" 
                                 :statusid="status.id">
                                 </postcomment>
                    <likestatus :statusid="status.id" :count="status.likes_count" :currentuser="currentuserid" ></likestatus>
                    <resharestatus :count="status.reshares_count" :status="status"></resharestatus>
                </div>
                </div>
            <div class="level-right" v-show="isOwnedBy(status.user.id)">
                <button class="button" @click.prevent.self @click="deleteStatus(status.id) " type="submit">Delete Status</button>
            </div>
        </nav>
        </div>
    </article>
    </a>
    </div>
    </div>
<nav v-show="paginate" class="pagination is-rounded" role="navigation" aria-label="pagination">
  <a class="pagination-previous" :disabled="onFirstPage" @click="loadPreviousPage">Previous Set of Statuses</a>
  <a class="pagination-next" :disabled="onLastPage" @click.prevent="loadNextPage">Next Set of Statuses</a>
</nav>
  </div>
</template>

<script>
import {EventBus} from './../../utilities/EventBus'
import Form from './../../utilities/Form'
import postcomment  from "./PostComment";
import likestatus  from "./LikeStatus";
import resharestatus  from "./ReshareStatus";
import NameAndTimeHeader  from "./../Users/NameAndTimeHeader";
import imagegallery  from "./../Status/ImageGallery";
    export default {
        props:['urlpath','currentuserid','profileuser'],
        components:{
            'postcomment': postcomment,
            'likestatus': likestatus,
            'resharestatus': resharestatus,
            'nameandtimeheader': NameAndTimeHeader,
            'imagegallery': imagegallery

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
             imagePath: this.urlpath,
             status:'',
             nextPage:'',
             previousPage:'',
             onFirstPage: '',
             stream:'',
             onLastPage: null,
             paginate: false,
        }
        },
        methods:{
            newStatus(status){
                this.statuses.unshift(status)
                this.getStatus()
            },
            getStatus(){
                if(this.profileuser != null){
                    return  axios.get(this.stream+'?User='+this.profileuser).then(response=>(this.prepareStatus(response.data)))
                }
                else{
                return  axios.get(this.stream).then(response=>(this.prepareStatus(response.data)))    
                }
            },

            prepareStatus(statuses){
                if(statuses.from != statuses.last_page && statuses.from != null)
              {
                  this.paginate = true
                  this.setPagination(statuses)
              }                   
                else{
                    this.paginate = false
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
            addImageIDtoStatus(IDS){
                },
            listenForEvents(){
                EventBus.$on('status_posted',status=>{
                    this.newStatus(status)})              
                EventBus.$on('reply-added',reply=>{this.getStatus()})
                EventBus.$on("user_unfollowed", unfollowed=> {this.getStatus()})
                },
                imageIfExisting(image){
                    if(image.length == 0){
                        return "/default.jpg"
                    }
                    else{
                        return "/"+image[0].thumb;
                    }
                },
             decorateUsername(username){
               return "/user/@"+username
            },
        reduceBody(body){
            return body.substring(0,50) + "..."
        }
        },
    }
</script>
