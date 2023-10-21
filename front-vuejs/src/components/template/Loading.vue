<template>
    <div class="loading" v-if="isLoading">
        <b-spinner label="Spinning"></b-spinner>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'Loading',
  computed: mapState(['isLoading'])
}
</script>

<style>
.loading {
    grid-area: content;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0,0,0,0.7);
    z-index: 9999;
}
</style>
