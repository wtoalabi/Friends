<template>
    <div>
        <div v-for="status in statuses" :key="status.id">
            <div class="box message mb-1" :class="status.mood.color">
                <article class="media message-body">
                    <div class="media-left">
                        <figure class="image is-65x65">
                            <img class="avatar is-circle" :src="imagePath+status.user.profile_image.path" alt="Image">
                        </figure>
                    </div>
        <div class="media-content">
            <div class="content">
                <p>
                    
                    <strong><a :href="status.user.username">{{status.user.name}}</a></strong> 
                        <small>{{status.user.username}}</small> <small>{{formatDate(status.created_at)}}</small>
                        <br>
                {{status.body}}
                </p>
            </div>
        <nav class="level is-mobile">
            <div class="level-left">
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-reply"></i></span>
                </a>
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                </a>
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-heart"></i></span>
                </a>
            </div>
        </nav>
        </div>
    </article>
</div>
      </div>
  </div>
</template>

<script>
import moment from 'moment'
    export default {
        props:['urlpath'],

        mounted(){
            this.getStatus()
            //console.log("dddd");
            //this.getStatus()
            //console.log(this.profileid)
        }, 
        data(){
            return{
             statuses:[],
             imagePath: this.urlpath+"/"
        }
        },
        methods:{
            
            getStatus(){
                return  axios.get('/get-statuses').then(response=>(this.prepareStatus(response.data.data)))
            },

            prepareStatus(statuses){
                this.statuses = statuses
            },

            formatDate(date){
                var differencesInTime = this.getTimeDifferences(date)
                return this.formatTimeText(differencesInTime, date)
            },

            getTimeDifferences(date){
                var created_at = moment(date).format()
                var timeNow = moment().format()
                var createdInSeconds = moment(created_at);
                var nowInSeconds = moment(timeNow);
                var differencesInTime= nowInSeconds.diff(createdInSeconds, 'seconds')
                return differencesInTime - 3600
            },
            formatTimeText(differencesInTime, date){
                if(differencesInTime <= 10){
                    return "few seconds ago"
                }
                else if(differencesInTime <= 59){
                    return "about a minutes ago"
                }
                else if(differencesInTime <= 600 ){
                    return "few minutes ago"
                }
                else if(differencesInTime <= 2000 ){
                    return "less than an hour ago"
                }
                else if(differencesInTime >= 3600 ){
                    return moment(date).startOf('minutes').fromNow(); 
                }
                
            }
        },
    }
</script>
