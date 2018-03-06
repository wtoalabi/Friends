<template>
  <div>
      <div class="file is-boxed is-centered is-info" @click="pictureUploadClicked()">
  <label class="file-label">
    <div class="file-input" type="file" name="resume"></div>
    <span class="file-cta">
      <span class="file-icon">
        <i class="fa fa-upload"></i>
      </span>
      <span class="file-label">
        Upload New Pictures...
      </span>
    </span>
  </label>
</div>
<picturesupload 
    :token="token"
    :url="'/upload-pictures/'+this.folderid + '/' +this.albumid">
</picturesupload>
  </div>
</template>

<script>
import { EventBus } from '../../utilities/EventBus';
import PicturesUpload from './../Status/PicturesUpload'
export default {
props:['token','folderid','albumid'],
components:{
    'picturesupload':PicturesUpload
    },
methods:{
    pictureUploadClicked(){
        EventBus.$emit('PictureUploadClicked');
    }
}
}
</script>

