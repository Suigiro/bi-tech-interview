<template>
  <header class="header">
    <a class="toggle" @click="toggleMenu" v-if="!hideToggle">
      <i class="fa fa-lg" :class="icon"></i>
    </a>
    <h1 class="title" v-if="!hideConfig">
      <router-link to="/home">{{ title }}</router-link>
    </h1>
    <h1 v-else class="title">{{ title }}</h1>
    <Config v-if="!hideConfig" />
  </header>
</template>

<script>
import Config from './Config'

export default {
  name: 'Header',
  components: { Config },
  props: {
    title: String,
    hideToggle: Boolean,
    hideConfig: Boolean
  },
  computed: {
    icon () {
      return this.$store.state.isMenuVisible ? 'fa-angle-left' : 'fa-angle-down'
    }
  },
  methods: {
    toggleMenu () {
      this.$store.commit('toggleMenu')
    }
  }
}
</script>

<style>
 .header {
        grid-area: header;
        background: linear-gradient(to right, #0c1d59, #305bf2);

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .title {
        font-size: 1.2rem;
        color: #fff;
        font-weight: 100;
        flex-grow: 1;
        text-align: center;
    }

    .title a {
        color: #FFF;
        text-decoration: none;
    }

    .title a:hover {
        color: #FFF;
        text-decoration: none;
    }

    header.header > a.toggle {
        width: 60px;
        height: 100%;
        color: #fff;
        justify-self: flex-start;
        text-decoration: none;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    header.header > a.toggle:hover {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.2);
    }
</style>
