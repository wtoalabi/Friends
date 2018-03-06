<template>
    <div>
        <div class="">
            <div class="">
                <a class="button is-info" @click.prevent="activateModal()">
                    <span class="title is-4 has-text-white">Create a New Album...</span>
                </a>
            </div>
        </div>
        <div class="modal" :class="activeModal">
            <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Create a New Album</p>
                        <button class="delete" aria-label="close" @click="closeModal()"></button>
                    </header>
                    <section class="modal-card-body">
                        <form class="form" method="post" @keydown="form.errors.clear($event.target.name)">
                            <div class="field" >
                            <label class="label">Name of Album</label>
                                <div class="control">
                                    <input class="input" 
                                        :class="{'is-danger':form.errors.has('albumName')}"
                                        type="text" 
                                        placeholder="Input the name of your album"
                                        v-model="form.albumName">
                                        <span class="help is-danger" v-if="form.errors.has('albumName')">{{form.errors.get('albumName')}} </span>
                                </div>
                            </div>

                            <div class="field" :class="hasError">
                            <label class="label">Description</label>
                                <div class="control">
                                    <textarea 
                                        class="textarea" 
                                        placeholder="What best describes this album?"
                                        v-model="form.albumDescription">
                                    </textarea>
                                </div>
                            </div>
                        </form>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success" @click.prevent="submittedAlbum()" :disabled="form.errors.any()">Submit</button>
                        <button class="button" @click="closeModal()">Cancel</button>
                    </footer>
                </div>
            </div>
        </div>
</template>

<script>
import Form from "./../../utilities/Form"
import { EventBus } from '../../utilities/EventBus';
export default {
props:[],
components:{},
data(){
    return{
        activeModal: '',
        form: new Form({
            albumName:'',
            albumDescription:''
        }),
        hasError: 'is-danger',
    }
},
methods:{
    activateModal(){
        this.activeModal = 'is-active'
    },
    closeModal(){
        this.activeModal = false
    },
    submittedAlbum(){
        return this.form.post('/create-albums').then(response=>(this.addAlbum(response)))
    },
    addAlbum(response){
        this.closeModal()
        EventBus.$emit('AlbumCreated', response);
    }

}
}
</script>