<template>
    <div>
        <div>
            <usercard
                :usersdata="followers"
                :imagepath="imagepath">
            </usercard>
        </div>
    </div>
</template>

<script>
import UserCard from "./../Users/UserCard"
export default {
  props:['userid','imagepath'],
  mounted(){
      this.getFollowers()      
  },
  components:{
      'usercard': UserCard
  },
  data(){
      return{
          followers:''
      }
  },
  methods:{
      getFollowers(){
        return axios.get('/friends/followers/'+this.userid).then(response=>(this.followers = response.data))
      },
      processFollowers(users){
        this.followers = users
      },
    chunkUsers(users){
        return users
        }
  },
}
</script>

