<template>
<div>
    <a :href="decorateUsername(user.username)">
        <p class="title has-text-centered mb-1">{{user.first_name}} {{user.last_name}}</p>
    </a> 
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <a :href="decorateUsername(user.username)">
                    <img class="" :src="imagePath" alt="Image">
                 </a> 
            </figure>
        </div>
        <div class="card-content">
            <div class="media">        
                <div class="media-content">
                    <a :href="decorateUsername(user.username)">
                        <p class="subtitle has-text-centered">{{"@"+user.username}}</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-footer column is-centered" v-show="!isProfileUser">
            <div class="columns is-centered">
                <div class="column has-text-centered">
                    <followbutton :following="propuserid" :isfollowed="this.propisfollowed"></followbutton>
                </div>
            </div>
        </div>
        <div class="column is-centered card-footer">
            <div class="columns">
                <span class="column is-8 title is-size-4">{{pluraliseStatus(statusesCount)}}</span> 
                <span class="column is-4" v-if="statusesCount"> <span class="button mb-1"> <span class="has-text-success is-link is-size-6">{{statusesCount}}</span></span> </span>
            </div>
        </div>
        <div class="column is-centered card-footer">
            <a :href="'/friends/list/@'+propusername">
                <div class="columns">
                    <span class="column is-8 title is-size-4"> Followers: </span> 
                    <span class="column is-4"> <span class="button mb-1"> <span class="has-text-success is-link is-size-6">{{followersCount}}</span></span></span> 
                </div>
            </a>
        </div>
        <div class="column is-centered card-footer">
            <a :href="'/friends/list/@'+propusername">
                <div class="columns">
                    <span class="column is-8 title is-size-4"> Following: </span> 
                    <span class="column is-4"> <span class="button mb-1"><span class="has-text-info is-link is-size-6">{{followingCount}}</span></span></span>
                </div>
            </a>
        </div>
  </div>
  </div>
</template>

<script>
import followbutton from './../Users/FollowButton'
import {EventBus} from './../../utilities/EventBus'
export default {
    props:['propuserid', 'propimagepath', 'propcurrentuserid','propisfollowed','propusername'],
    components:{
        'followbutton': followbutton
    },
  mounted(){
      this.getUser()
      this.confirmIfProfileUser()
      this.listenToEvents()
        },
  data(){
      return{
          user: '',
          imagePath: '',
          currentUser:'',
          isProfileUser: '',
          followersCount: '',
          followingCount: '',
          statusesCount: ''
      }
  },
  methods:{
      getUser(){
          return axios.get('/get-user/'+this.propuserid).then(response=>(this.prepareUser(response.data)))
      },
      prepareUser(user){
          this.user = user
          if(user.images.length == 0){
              this.imagePath = this.propimagepath+"/default.jpg"
          }else{
            this.imagePath = this.propimagepath+"/"+ user.images[0].thumb
          }
          this.currentUser = this.propcurrentuserid
          this.followersCount = user.followers_count
          this.followingCount = user.following_count
          this.statusesCount = user.statuses_count
      },
      decorateUsername(username){
          return "/user/@"+username
      },
      confirmIfProfileUser(){
          if(this.propuserid == this.propcurrentuserid){
              return this.isProfileUser = true
          }
      },
      pluraliseStatus(count){
          if(count==0){
              return "No status yet!"
          }

          if(count == 1){
              return "Status:"
          }

          else if(count > 1){
              return "Statuses:"
          }
      },
      listenToEvents(){
        EventBus.$on('user-followed', followed=> {this.getUser()})
        EventBus.$on('status-shared',status=>{this.getUser()})
        EventBus.$on('status-posted',status=>{this.getUser()})
        EventBus.$on('status-deleted',status=>{this.getUser()})
        EventBus.$on('user-unfollowed', unfollowed=> {this.getUser()})
      }
    }
}
</script>

