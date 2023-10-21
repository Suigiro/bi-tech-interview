<template>
    <div class="page-title">
         <h1><i v-if="icon" :class="icon"></i>&nbsp;&nbsp;{{ main }}&nbsp;&nbsp;<i v-if="icon" class="fa fa-refresh" @click="reloadPage()"></i></h1>
        <h2 :class="destacar ? 'destacar':''">{{ sub }}</h2>
    </div>
</template>

<script>
export default {
  name: 'PageTitle',
  props: ['icon', 'main', 'sub', 'destacar'],
  methods: {
    reloadPage () {
      location.reload()
    }
  }
}
</script>

<style>
.page-title h1 {
    margin: 0px;
}

.page-title h2 {
    color: #777;
    margin-top: 5px;
    font-size: 1.3rem;
}
.destacar {
    font-weight: 900;
}
.fa-refresh {
  cursor: pointer;
}

</style>
