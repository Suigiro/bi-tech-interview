<template>
  <div id="app" :class="{'hide-menu': !isMenuVisible || !usuario}">
    <Header title="Saude Pacientes"
    :hideToggle="!usuario"
    :hideConfig="!usuario" />
    <Menu v-if="usuario"/>
    <Content />
    <Footer />
    <Loading />
  </div>
</template>

<script>
import { mapState } from 'vuex'
import Header from '@/components/template/Header'
import Menu from '@/components/template/Menu'
import Content from '@/components/template/Content'
import Footer from '@/components/template/Footer'
import { userKey } from '@/config/global'
import Loading from '@/components/template/Loading'

export default {
  name: 'App',
  components: { Header, Menu, Content, Footer, Loading },
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'usuario', 'isLoading']),
  data () {
    return {
      validatingToken: true
    }
  },
  methods: {
    async validateToken () {
      this.validatingToken = true

      const json = localStorage.getItem(userKey)
      const usuarioData = JSON.parse(json)
      this.$store.commit('setUsuario', usuarioData)
      this.$store.commit('setIsMenuVisible', true)

      if (!usuarioData) {
        this.validatingToken = false
        this.$store.commit('setIsMenuVisible', false)
        this.$router.push({ name: 'auth' })
        return
      }

      this.validatingToken = false
    }
  },
  created () {
    this.validateToken()
  }
}
</script>

<style>
  * {
    font-family: 'Lato', sans-serif
  }
  body {
    margin: 0;
  }
  #app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;

    height: 100vh;
    display: grid;
    grid-template-rows: 60px 1fr 40px;
    grid-template-columns: 300px 1fr;
    grid-template-areas:
          "header header"
          "menu content"
          "menu footer"
  }
  #app.hide-menu
  {
       grid-template-areas:
          "header header"
          "content content"
          "footer footer"
  }
</style>
