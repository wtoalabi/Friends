<template>
  <div>
      <div class="box message mb-1" :class="status.mood.color">
            <a :href="'/'+status.slug" @click.self.prevent>
                <article class="media message-body">
                    <div class="media-left">
                        <a :href="decorateUsername(status.user.username)">
                            <figure class="image is-65x65">
                                <img class="avatar is-circle" :src="imagePath + imageIfExisting(status.user)" alt="Image">
                            </figure>
                        </a>
                    </div>
        <div class="media-content">
            <div class="content">          
                <nameandtimeheader 
                        :time="status.created_at"
                        :resharedfrom="status.reshared_from"
                        :statusowner="status.user"
                        :statusoriginalid="status.original_id">
                </nameandtimeheader>
                    <div>
                        {{status.body}}
                    </div>
                <imagegallery v-if="status.status_images"
                    :images="status.status_images"
                    :path="imagePath"
                    :lightbox="lightbox">
                </imagegallery>
            </div>
            <statusfooterlinks
                :status="status"
                :currentuserid="currentuserid">
            </statusfooterlinks>
        </div>
    </article>
    </a>
    </div>
  </div>
</template>

<script>
import NameAndTimeHeader  from "./../Users/NameAndTimeHeader";
import imagegallery  from "./../Status/ImageGallery";
import StatusFooterLinks from "./StatusFooterLinks"

export default {
    props: ['status', 'imagePath','lightbox','currentuserid'],
    components:{
        'nameandtimeheader':NameAndTimeHeader,
        'imagegallery': imagegallery,
        'statusfooterlinks': StatusFooterLinks
    },
        data(){
            return{
        }
    },
    methods:{
        decorateUsername(username){
            return "/user/@"+username
        },
        imageIfExisting(user){            
            if(user.images == 0){
                return "/default.jpg"
            }
            else{
                return "/"+image[0].thumb;
            }
        },
    }
}
</script>
