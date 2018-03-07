<template>
    <div>
        <spinner v-if="loading" size="massive"></spinner>        
        <div v-if="loggedinuserid == userid">
            <uploadbutton v-if="this.folderid != 1 && this.folderid != 2"
                class="mb-2"
                :token="token"
                :folderid="folderid"
                :albumid="albumid">
            </uploadbutton>
        </div>
        <div v-if="pictures.length == 0"> No Picture </div>
            <div v-for="chunkedPictures in pictures" :key="chunkedPictures.id" class="columns">
                <div v-for="picture in chunkedPictures" :key="picture.id" class="column is-3" :class="picture.profile ? profilePicture : null">
                    <img  :src="imagepath+'/'+picture.thumb" alt="" @mouseover="showOptionPanel(picture.id)"
                        v-img="{ 
                        title: albumname, 
                        group: pictures, 
                        src: imagepath + '/' + picture.full,
                        sourceButton: true}">
                    
                    <div v-if="optionPanel == picture.id && loggedinuserid == userid">
                        <div class="columns optional" v-if="picture.profile != 1">
                            <div class="column is-7">
                                <span class="button is-warning is-small" @click="makeProfileImage(picture.id)">Make Profile Image</span>
                            </div>
                            <div class="column is-5 ml-1">
                                <span class="button is-danger is-small" @click="deleteImage(picture.id)">Delete</span>
                            </div>
                        </div>
                    <div v-else>
                        <span class="button is-primary is-small">Current Profile Picture</span>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
import Spinner from "vue-simple-spinner"
import UploadButton from "./UploadButton"
import { EventBus } from '../../utilities/EventBus';
import Form from "./../../utilities/Form"
export default {

    props:['folderid','userid','imagepath','albumname', 'token', 'albumid', 'loggedinuserid'],
    mounted(){        
        this.getPictures(),
        this.listenForEvents()    
    },
    components:{
        'spinner' : Spinner,
        'uploadbutton': UploadButton
    },
    data(){
        return{
            form: new Form({
                    body: '',
                    body: "Posted in "+ this.albumname +' Album...',
                    mood: 1,
                    profileID: this.loggedinuserid,
                    pictures:[]
                }),
            pictures:'',
            loading: '',
            optionPanel:'',
            profilePicture:'profilePicture'
        }
    },
    methods:{
        getPictures(){
            this.loading = true
            return axios.get('/get-folder-pictures/'+this.userid + '/' +this.folderid).then(response=>(this.preparePictures(response.data)))
        },
        preparePictures(pictures){
            this.loading = false
            this.pictures = _.chunk(pictures, 4)
        },
        listenForEvents(){
            EventBus.$on('picture-uploaded', pictures=>{this.getPictureIDs(pictures)})
            EventBus.$on('PictureModalClosed',picture=>{this.sendStatus()})
        },
        getPictureIDs(pictureIDs){
            this.getPictures()
            this.form.pictures = pictureIDs
        },
        sendStatus(){
            return this.form.post('/create-picture-status').then(response=>(this.getPictures()))  
            
        },
        showOptionPanel(id){
            this.optionPanel = id            
        },
        makeProfileImage(id){
            if(confirm("Are you sure you want this image as your profile picture?")){
                return axios.post('/make-profile-picture/'+id).then(response=>(this.profilePictureChanged(response)))
            }
        },
        profilePictureChanged(){
            this.getPictures()
            EventBus.$emit('ProfilePictureChanged')
        },
        deleteImage(id){
            if(confirm("Are you sure you want to delete this image?")){
                return axios.delete('/delete-picture/' +id).then(response=>(this.pictureDeleted(response)))
            }
        },
        pictureDeleted(){
            this.getPictures()
            EventBus.$emit('PictureDeleted')

        }
    }
}
</script>
