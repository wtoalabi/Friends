<template>
    <div>
        <breadcrumb :load="PicturesPage"></breadcrumb>
        <spinner v-if="loading"
            size="massive">
        </spinner>
        <div v-if="loadAlbums" v-for="chunkedAlbums in albums" :key="chunkedAlbums.id" class="columns is-centered">
            <div v-for="album in chunkedAlbums" :key="album.id" class="column is-4">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <a class="button is-primary" @click.prevent="loadPictures(album.folderID, album.name, album.images_count)" :disabled="album.images_count<1">
                            <span class="title is-4 has-text-white">{{album.name}}</span>
                        </a>
                        <div class="columns is-centered mt-1">
                            <div class="tags has-addons mb-2">
                                <span class="tag">Count</span>
                                <span class="tag is-danger">{{album.images_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <pictureslisting v-if="PicturesPage"
        :folderid="folderID"
        :userid="user.id"
        :imagepath="imagepath"
        :albumname="albumName">
    </pictureslisting>
    </div>
</template>

<script>
import {EventBus} from "./../../utilities/EventBus"
import Breadcrumb from "./Breadcrumbs"
import PicturesListing from "./PicturesListing"
import PictureUpload from "./PictureUpload"
import Spinner from 'vue-simple-spinner'
export default {
props:['user', 'imagepath',], 
mounted(){    
    this.listenForEvents()
    this.getFolders()
},components:{
    'pictureslisting': PicturesListing,
    'pictureupload': PictureUpload,
    'spinner': Spinner,
    'breadcrumb': Breadcrumb
},
data(){
    return{
        albums: '',
        loading: '',
        PicturesPage: false,
        albumName: '',
        loadAlbums: '',
        folderID: ''
    }
},
methods:{
    getFolders(){        
        this.loading = true
        return axios.get('/get-user-folders/'+this.user.id).then(response=>(this.prepareFolder(response.data)))
    },
    prepareFolder(response){
        this.loading = false
        this.loadAlbums = true
        var result = _.sortBy(response, ['folderID']);
        this.albums = _.chunk(result, 3)
        this.PicturesPage = false
        },
    loadPictures(folderID, name, count){
        if(count >= 1){
        this.folderID = folderID
        this.albumName = name
        this.PicturesPage = true
        this.loadAlbums = false
        }
    },
    listenForEvents(){
        EventBus.$on('MainPage',load=>{this.hideBreadcrumbs()})
    },
    hideBreadcrumbs(){       
        this.PicturesPage = false
        this.loadAlbums = false
        this.getFolders()
    }
    },

}
</script>