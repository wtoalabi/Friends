<template>
  <div>
      
    <div v-for="groupedUsers in chunkUsers(usersdata)" :key="groupedUsers.id">
        <div class="columns">
            <div class="message is-primary mb-1 column is-3" v-for="user in groupedUsers" :key="user.id">
                <div class="">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img class="" :src="linkToThumb(user.images)" alt="Image">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
  </div>
</template>

<script>
export default {
  props:['usersdata', 'imagepath'],
  mounted(){
      console.log(this.usersdata);  
  },
  data(){
      return{
      }
  },
  methods:{
        
        chunkUsers(users){
            return _.chunk(users,4);
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
            reduceFirstNameCharacters(name){
                var reducedname = name.substring(0,6)
                    return reducedname + "..."
            }
    }
}
</script>