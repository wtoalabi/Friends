<template>
    <div>
        <breadcrumb :load="PicturesPage"></breadcrumb>
        <spinner v-if="loading"
            size="massive">
        </spinner>
        <div v-if="loadAlbums" >
            <div class="columns is-centered">
                <createalbum></createalbum>
            </div>
        <div v-for="chunkedAlbums in albums" :key="chunkedAlbums.id" class="columns is-centered">
            <div v-for="album in chunkedAlbums" :key="album.id" class="column is-4">
                <div class="card" @mouseover="showDelete(album.folderID)" @mouseout="hideDelete(album.folderID)">
                    <div class="card-content has-text-centered">
                        <a class="button is-primary" @click.prevent="loadPictures(album.folderID, album.name, album.images_count,album.id)" :disabled="album.images_count<1 && user.id != loggedinuserid">
                            <span class="title is-4 has-text-white">{{album.name}}</span>
                        </a>
                        <div class="columns is-centered mt-1">
                            <div class="tags has-addons mb-2">
                                <span class="tag">Count</span>
                                <span class="tag is-danger">{{album.images_count}}</span>
                            </div>
                            <div v-if="loggedinuserid == user.id">
                                <div v-if="album.folderID !=1 && album.folderID !=2 && showDeleteButton==album.folderID" class="tags has-addons mb-2">
                                    <span class="tag">Delete</span>
                                </div>
                            </div>
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
        :albumname="albumName"
        :token="token"
        :albumid="albumID"
        :loggedinuserid="loggedinuserid">
    </pictureslisting>
    </div>
</template>

<script>
import {EventBus} from "./../../utilities/EventBus"
import Breadcrumb from "./Breadcrumbs"
import PicturesListing from "./PicturesListing"
import Spinner from 'vue-simple-spinner'
import CreateAlbum from "./CreateAlbum"
export default {
props:['user', 'imagepath','loggedinuserid', 'token'], 
mounted(){    
    this.listenForEvents()
    this.getFolders()
},components:{
    'pictureslisting': PicturesListing,
    'spinner': Spinner,
    'breadcrumb': Breadcrumb,
    'createalbum':CreateAlbum
},
data(){
    return{
        albums: '',
        loading: '',
        PicturesPage: false,
        albumName: '',
        loadAlbums: '',
        folderID: '',
        albumID:'',
        showDeleteButton:false
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
        var result = _.orderBy(response, ['created_at'],['asc']);
        this.albums = _.chunk(result, 3)
        this.PicturesPage = false
        
        },
    loadPictures(folderID, name, count, albumID){        
        if(count >= 1 || this.user.id == this.loggedinuserid ){
        this.folderID = folderID
        this.albumName = name
        this.PicturesPage = true
        this.loadAlbums = false
        this.albumID = albumID
        }
    },
    listenForEvents(){
        EventBus.$on('MainPage',load=>{this.hideBreadcrumbs()})
        EventBus.$on('AlbumCreated',album=>{this.getFolders()})

    },
    hideBreadcrumbs(){       
        this.PicturesPage = false
        this.loadAlbums = false
        this.getFolders()
    },
    showDelete(albumid){
        this.showDeleteButton = albumid
    },
    hideDelete(albumid){
        this.showDeleteButton = false
    }
    },

}
</script>