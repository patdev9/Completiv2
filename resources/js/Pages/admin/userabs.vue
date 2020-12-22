<template>
  <app-layout>
      {{this.$props.user.email}}
      <div >

      </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
export default {
  components: { AppLayout },
  props:['absence','user']

}
</script>

<style>

</style>