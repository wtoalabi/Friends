<template>
    <div>
        <div v-for="comment in comments" :key="comment.id">        
            <singlecomment 
                :ImagePath="ImagePath"
                :comment="comment"
                :statusid="statusid">
            </singlecomment>
        </div>
            <div v-if="paginate">
                <span class="button is-link" :class="isLoading" @click="loadMore">Load More...</span>
            </div>
    </div>  
</template>

<script>

import {EventBus} from './../../../utilities/EventBus'
import SingleComment from './SingleComment'
export default {
    props:['statusid', 'ImagePath'],
    mounted(){
        this.getCommentsPath = '/get-comments/' + this.statusid
        this.getComments()
        this.listenToEvents()
    },
    components:{
        'singlecomment': SingleComment
    },
    data(){
        return{
            comments: null,
            paginate: false,
            isLoading: '',
            getCommentsPath: ''
        }
    },

    methods:{
        getComments(){
            this.isLoading = 'is-loading'
            return axios.get(this.getCommentsPath).then(response=>(this.prepareComments(response.data)))
        },
        prepareComments(response){   
            console.log(response)
            this.isLoading = ''
            if(response.from != response.last_page){
                this.setPagination(response)    
            }
            else if(response.from == response.last_page){
                this.comments = this.comments.concat(response.data)
                this.paginate = false
            }
            else{
                this.paginate = false
                return this.comments = response.data
            }
        },
        setPagination(response){
            this.paginate =true
                if(this.comments == null){
                    this.comments = response.data
                }
                else{
                    this.comments = this.comments.concat(response.data)
                }
                this.getCommentsPath = response.next_page_url
        },
        loadMore(){
            this.getComments()
        },
        addComment(comment){
            this.comments.unshift(comment)
        },
        listenToEvents(){
            EventBus.$on('comment-added', comment=>{this.addComment(comment)})
        },
      
    },
  
}
</script>
