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
        this.getCommentsPath = this.defaultPath
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
            defaultPath:  '/get-comments/' + this.statusid,
            getCommentsPath:''
        }
    },

    methods:{
        getComments(){
            this.isLoading = 'is-loading'
            return axios.get(this.getCommentsPath).then(response=>(this.prepareComments(response.data)))
        },
        prepareComments(response){   
            this.isLoading = ''
            //Does Pagination Exists?
            if(response.total > response.current_page){
                return this.setPagination(response)                
            }
            else if(response.total == 0){ 
                this.paginate = false                
            }
            return this.comments = response.data
        },
        setPagination(response){
            this.paginate =true
            if(this.comments == null){
                this.comments = response.data
            }
            else{
                var current = this.comments
                var incoming = response.data
                var newcomments = _.concat(current,incoming)
                this.comments = _.uniqBy(newcomments,'id')            
            }
            if(response.current_page == response.last_page){
                this.paginate = false
            }
            this.getCommentsPath = response.next_page_url
        },
        loadMore(){
            this.getComments()
        },
        addComment(comment){
            if(this.getCommentsPath != this.defaultPath){
                
                return this.comments.unshift(comment)

            }
            else{
            this.comments = null
            this.getCommentsPath = this.defaultPath
            console.log(this.comments)
            this.getComments()
            console.log(this.comments)
            }
        },
        listenToEvents(){
            EventBus.$on('comment-added', comment=>{this.addComment(comment)})
        },
      
    },
  
}
</script>
