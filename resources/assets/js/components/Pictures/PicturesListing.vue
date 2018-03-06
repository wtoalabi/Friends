<template>
    <div>
        <spinner v-if="loading"
            size="massive">
        </spinner>
        <div v-if="loggedinuserid == userid">
            <uploadbutton v-if="this.folderid != 1 && this.folderid != 2"
                class="mb-2"
                :token="token"
                :folderid="folderid"
                :albumid="albumid">
            </uploadbutton>
        </div>
        <div v-for="chunkedPictures in pictures" :key="chunkedPictures.id" class="columns">
            <div v-for="picture in chunkedPictures" :key="picture.id" class="column is-3">
                <img :src="imagepath+'/'+picture.thumb" alt=""
                    v-img="{ 
                    title: albumname, 
                    group: pictures, 
                    src: imagepath + '/' + picture.full,
                    sourceButton: true}">
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
                    body: "Posted in "+ this.albumname +'Album...',
                    mood: 1,
                    profileID: this.loggedinuserid,
                    pictures:[]
                }),
            pictures:'',
            loading: ''
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
    }
}
</script>
