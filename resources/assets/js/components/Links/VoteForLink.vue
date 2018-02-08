<template>
<div class="tags has-addons">   
    <span class="tag is-danger" v-if="voted" @click.prevent="downVote(link)"><a href="#"><span class="has-text-white"> Downvote</span></a></span>
    <span class="tag is-danger" v-else @click.prevent="upVote(link)"><a href="#"><span class="has-text-white">Vote</span></a></span>
    <span class="tag is-success">{{score}}</span>
</div>
</template>

<script>
    export default {
        props:['votedfor', 'link', 'totalscore'],
        data(){
            return{
                voted:'',
                score: ''
            }
        },
        methods:{
            downVote(link){
                 axios.get('/downVote/'+link)
                    .then(response => this.downVoted())
                    .catch(response => console.log(response.data));
            },
            upVote(link){
                 axios.get('/voteFor/'+link)
                    .then(response => this.upVoted())
                    .catch(response => console.log(response.data));
            },
            downVoted(){
                this.voted = false
                this.score--
            },
            upVoted(){
                this.voted = true
                this.score++
            }
        },
        mounted() {
            this.voted = this.votedfor;
            this.score = this.totalscore
        }
    }
</script>