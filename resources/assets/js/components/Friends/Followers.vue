<template>
    <div>
        <spinner v-if="loading"
            message="loading..."
            size="huge">
        </spinner>
            <usercard
                :usersdata="followers"
                :imagepath="imagepath"
                :columnsize="'is-3'"
                :chunksize="3"
                :loggedinuserid="loggedinuserid">
            </usercard>
        {{nofollower}}
    </div>
</template>

<script>
import UserCard from "./../Users/UserCard"
import Spinner from 'vue-simple-spinner'
export default {
  props:['userid','imagepath','loggedinuserid'],
  mounted(){      
      this.getFollowers()      
  },
  components:{
      'usercard': UserCard,
      'spinner':Spinner
  },
  data(){
      return{
          followers:'',
          loading:'',
          nofollower:''
      }
  },
  methods:{
      getFollowers(){
        this.loading = true
        return axios.get('/friends/followers/'+this.userid).then(response=>(this.processFollowers(response.data)))
      },
      processFollowers(users){
        this.loading = false
        if(users.length > 0){
            this.followers = users        
        }
        else{
            this.nofollower = "There are no followers yet!"
        }
      },
    chunkUsers(users){
        return users
        }
  },
}
</script>

