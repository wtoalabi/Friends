<template>
  <div>
      
    <div v-for="groupedUsers in chunkUsers(usersdata)" :key="groupedUsers.id">
        <div class="columns">
            <div class="message is-primary mb-1 column" :class="columnsize" v-for="user in groupedUsers" :key="user.id">
                <div class="">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <a :href="linkToUsername(user.username)">
                                    <img class="" :src="linkToThumb(user.images)" alt="Image">
                                </a> 
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">        
                                <div class="media-content">
                                    <a :href="linkToUsername(user.username)">
                                        <p class="title is-5">{{user.first_name}} {{user.last_name}}</p>
                                    </a> 
                                        <p class="subtitle is-">@{{user.username}}</p>
                                </div>
                            </div>
                            <div v-if="user.id != loggedinuserid">
                                <followbutton
                                    :recipientuserid="user.id">
                                </followbutton>
                            </div>
                            <div v-else>
                                <span class="button is-warning">Yours Truly....</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
  </div>
</template>

<script>
import FollowButton from "./FollowButton"
export default {
  props:['usersdata', 'imagepath','columnsize','chunksize','loggedinuserid'],
  mounted(){
  },
  components:{
      'followbutton': FollowButton
  },
  data(){
      return{
      }
  },
  methods:{
        
        chunkUsers(users){
            return _.chunk(users,this.chunksize);
        },
        
        linkToThumb(image){
            if(image == 0){
                return this.imagepath+ "/" +"default.jpg"
            }
            else{
                return this.imagepath + "/" +image[0].thumb
            }
        },
            linkToUsername(username){
                return "/user/@"+username
        },
           
    }
}
</script>