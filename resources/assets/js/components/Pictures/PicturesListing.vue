<template>
    <div>
        <spinner v-if="loading"
            size="massive">
        </spinner>
        <div v-for="chunkedPictures in pictures" :key="chunkedPictures.id" class="columns">
            <div v-for="picture in chunkedPictures" :key="picture.id" class="column is-3">
                <img :src="imagepath+'/'+picture.thumb" alt=""
                    v-img="{ 
                    title: albumname, 
                    group: chunkedPictures, 
                    src: imagepath + '/' + picture.full,
                    sourceButton: true}">
            </div>
            
        </div>
</div>
  
</template>

<script>
import Spinner from "vue-simple-spinner"
export default {

    props:['folderid','userid','imagepath','albumname'],
    mounted(){
        this.getPictures()        
    },
    components:{
        'spinner' : Spinner
    },
    data(){
        return{
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

        }
    }
}
</script>
