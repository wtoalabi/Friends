<template>
    <div>
        <usercard
            :usersdata="allUsers"
            :imagepath="imagepath"
            :columnsize="4"
            :chunksize="3"
            :loggedinuserid="loggedinuserid">
        </usercard>
        <nav v-show="paginate" class="pagination is-rounded" role="navigation" aria-label="pagination">
            <a class="pagination-previous" :disabled="onFirstPage" @click="loadPreviousPage">Previous Set of Users</a>
            <a class="pagination-next" :disabled="onLastPage" @click.prevent="loadNextPage">Next Set of Users</a>
        </nav>
      
  </div>
</template>

<script>
import UserCard from "./../../Users/UserCard"
export default {
    props:['users', 'loggedinuserid', 'imagepath'],
    mounted(){
        this.url = '/get-all-users'
        this.getAllUsers()
        
    },
    components:{
        'usercard':UserCard
    },
    data(){
        return{
            allUsers: '',
            url: '',
            paginate:false,
            previousPage:'',
            nextPage:'',
            onFirstPage:'',
            onLastPage: null
        }
    },
    methods:{
        getAllUsers(){
            return axios.get(this.url).then(response=>(this.prepareUsers(response.data)))
        },
        prepareUsers(response){
            if(response.from != response.last_page && response.from != null){
            this.paginate = true
            this.setPagination(response)
        }                   
        else{
            this.paginate = false
        }
            this.allUsers = response.data            
        },
         setPagination(response){
                this.url = "/get-all-users/?page=" + response.current_page
                this.previousPage = response.prev_page_url
                this.nextPage = response.next_page_url
                this.disableButtons(response.from, response.to, response.total)
            },

            loadNextPage(){
                return  axios.get(this.nextPage).then(response=>(this.prepareUsers(response.data)))

            },
            loadPreviousPage(){
                return  axios.get(this.previousPage).then(response=>(this.prepareUsers(response.data)))
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
    }
}
</script>

<style>

</style>
