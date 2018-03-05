<template>
    <div>
        <nav class="breadcrumb is-centered is-medium has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a @click.prevent :class="followers" href="#" @click="followersClicked()">
                    <span class="icon is-small"><i class="fa fa-eye"></i></span><span>Followers</span></a>
                </li>
                <li><a @click.prevent href="#" :class="following" @click="followingClicked()">
                    <span class="icon is-small"><i class="fa fa-eye-slash"></i>
                    </span><span>Following</span></a>
                </li>
            </ul>
        </nav>
        <following 
            v-if="following"
            :userid="userid"
            :imagepath="imagepath"
            :loggedinuserid="loggedinuserid">
        </following>
        <followers 
            v-if="followers"
            :userid="userid"
            :imagepath="imagepath"
            :loggedinuserid="loggedinuserid">
        </followers>
  </div>
</template>

<script>
import Following from "./Following";
import Followers from "./Followers";
export default {
    props:['userid','imagepath','loggedinuserid'],
    mounted(){        
    },
    components:{
        'following': Following,
        'followers': Followers
    },
    data(){
        return{
            followers:'has-text-black',
            following:''
        }
    },

    methods:{
        followingClicked(){
            this.show
            this.following= 'has-text-black'
            this.followers= null
        },
        followersClicked(){
            this.followers= 'has-text-black'
            this.following= null

        }
    }
  
}
</script>
