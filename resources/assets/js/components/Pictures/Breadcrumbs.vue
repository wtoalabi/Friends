<template>
  <div v-if="load">
      <nav class="breadcrumb is-small" aria-label="breadcrumbs">
  <ul>
    <li @click="backToMainPage">
        <a href="#">Back to Main Pictures</a>
    </li>
  </ul>
</nav>
  </div>
</template>

<script>
import {EventBus} from "./../../utilities/EventBus"
export default {
    props:['load'],
  methods:{
      backToMainPage(){
          EventBus.$emit('MainPage');          
      }
  }
}
</script>
