<template>
  <div>
      <div>
        <spinner v-if="loading"
            message="loading..."
            size="huge">
        </spinner>
            <usercard
                :usersdata="followings"
                :imagepath="imagepath"
                :columnsize="'is-3'"
                :chunksize="4"
                :loggedinuserid="loggedinuserid">
            </usercard>
        {{nofollowing}}
    </div>
  </div>
</template>

<script>
import UserCard from "./../Users/UserCard"
import Spinner from 'vue-simple-spinner'
export default {
  props:['userid','imagepath','loggedinuserid'],
  mounted(){      
      console.log(this.userid);
      
      this.getFollowings()      
  },
  components:{
      'usercard': UserCard,
      'spinner':Spinner
  },
  data(){
      return{
          followings:'',
          loading:'',
          nofollowing:''
      }
  },
  methods:{
      getFollowings(){
        this.loading = true
        return axios.get('/friends/following/'+this.userid).then(response=>(this.processFollowings(response.data)))
      },
      processFollowings(users){                              
        this.loading = false
        if(users.length > 0){
            this.followings = users        
        }
        else{
            this.nofollowing = "Following no one yet!"
        }
      }
  },
}
</script>

