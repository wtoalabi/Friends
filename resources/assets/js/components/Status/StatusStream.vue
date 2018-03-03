<template>
    <div>
        <div v-for="status in statuses" :key="status.id">
            <singlestatus 
                :status="status"
                :imagePath="urlpath"
                :lightbox="false"
                :currentuserid="currentuserid">
            </singlestatus>
    </div>
<nav v-show="paginate" class="pagination is-rounded" role="navigation" aria-label="pagination">
  <a class="pagination-previous" :disabled="onFirstPage" @click="loadPreviousPage">Previous Set of Statuses</a>
  <a class="pagination-next" :disabled="onLastPage" @click.prevent="loadNextPage">Next Set of Statuses</a>
</nav>
  </div>
</template>

<script>
import {EventBus} from './../../utilities/EventBus'
import SingleStatus from "./SingleStatus"
    export default {
        props:['urlpath','currentuserid','profileuser'],
        components:{
            'singlestatus' : SingleStatus
        },
        mounted(){
            this.stream = '/stream'
            this.getStatus()
            this.listenForEvents()
        }, 
        data(){
            return{
             statuses:[],
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
                    return  axios.get(this.stream+'/'+this.profileuser).then(response=>(this.prepareStatus(response.data)))
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
            setPagination(data){
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
                EventBus.$on('status-posted',status=>{
                    this.newStatus(status)})              
                EventBus.$on("status-shared", status=> {this.newStatus(status)})
                EventBus.$on("status-deleted", status=> {this.getStatus()})
                //EventBus.$on("user-unfollowed", unfollowed=> {this.getStatus()})
                },        
        reduceBody(body){
            return body.substring(0,50) + "..."
        }
        },
    }
</script>
