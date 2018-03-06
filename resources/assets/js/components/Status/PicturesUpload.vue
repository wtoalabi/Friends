<template>
<div>
    <div class="modal" :class="ModalBox">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Drag or Drag Your Pictures</p>
                <button class="delete" aria-label="close" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <form id="Photos" 
                    class="dropzone"
                    method="POST">
                </form>
            </section>
            <footer class="modal-card-foot columns">
                <div class="column is-4" @click="closeModal"> <button class="button">Continue...</button></div>
                <span class="column"><em>Note: You cant upload more than 10 pictures at a time...</em></span><br>
            </footer>
  </div>
</div>
</div>
</template>
<script>
import Dropzone from './../../utilities/dropzone'
Dropzone.autoDiscover = false;
import {EventBus} from './../../utilities/EventBus'
Dropzone.options.Photos = {
    paramName: "picture", 
    maxFilesize: 1, // MB,
    createImageThumbnails: true,
    maxFiles: 10,    
    acceptedFiles: '.jpeg, .jpg, .png, .bmp',
};
export default {
    props:['token','url'],
    mounted(){
    this.setForm()
    this.listenForEvents()
},
    data(){
        return{
            ModalBox: '',
            imagesID:[],
            file: '',
            myDropzone:''
        }
    },
    methods:{
        openModal(){
            this.ModalBox = 'is-active'
            this.imagesID = []
            this.myDropzone.destroy();
            this.setForm()
        },
        closeModal(){
            this.ModalBox = null
            EventBus.$emit('PictureModalClosed')
        },
        addToPhotoToStatus(imageID, file){
            this.imagesID.push(imageID)
            EventBus.$emit('picture-uploaded', this.imagesID)
            this.file = file  
        },
        removeFileFromDB(id){
            return axios.delete('remove-picture'+"/" + id);
        },
        setForm(){
            var vm = this
            this.myDropzone = new Dropzone(".dropzone",{
            autoDiscover: false,
            url: this.url,
            headers: { "X-CSRF-TOKEN": this.token}
        });
            
        this.myDropzone.on("success", function(file, response) {
            console.log(response);
            
            vm.addToPhotoToStatus(response, file)
                });
               
        this.myDropzone.on("maxfilesexceeded", function(file, response) {
            alert('You cant upload more than 10 pictures at a time...you can remove some of those uploaded or simply make new post...')
                });
        },
    listenForEvents(){
        EventBus.$on('PictureUploadClicked', picture=>{this.openModal()})
    }
    },
  
}
</script>
