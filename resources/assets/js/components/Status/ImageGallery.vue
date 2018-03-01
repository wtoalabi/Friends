<template>
<div>
    <div class="columns is-centered" v-for="chunkedImages in chunkImages(galleryImages)" :key="chunkedImages.id">
        <div class="column" v-for="image in chunkedImages" :key="image.id">
            <img class="" v-if="lightbox" 
                v-img="{ 
                    title: title, 
                    group: chunkedImages, 
                    src: ImagePath + '/' + image.full,
                    sourceButton: true}"
                :src="ImagePath +'/' +image.thumb" alt="Image">
                <img class="" v-else :src="ImagePath +'/' +image.thumb" alt="Image">
            </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['images','path','lightbox', 'title'],
    mounted(){
        console.log(this.lightbox)
    },
    data(){
        return {
            galleryImages: this.images,
            ImagePath: this.path,
        }
    },
    methods:{
        chunkImages(images){
             var $length = images.length
             if(images.length == 2 || images.length == 4){  
                 return _.chunk(images, 2)
             }
             else if(images.length == 3 || images.length == 5 || images.length == 8){  
                 return _.chunk(images, 3)
             }
             else if(images.length == 6 || images.length == 7 || images.length == 10){  
                 return _.chunk(images, 4)
             }
             else if(images.length == 9){
                 return _.chunk(images, 5)
             }
             else{
                 return _.chunk(images, 1)
             }
        },
    },
  
}
</script>

