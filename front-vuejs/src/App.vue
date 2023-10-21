<template>
  <div id="app" :class="{'hide-menu': !isMenuVisible || !usuario}">
    <Header title="UDash - Sistema de Chamados"
    :hideToggle="!usuario"
    :hideConfig="!usuario" />
    <Menu v-if="usuario"/>
    <Content />
    <Footer />
  </div>
</template>

<script>
import { mapState } from 'vuex'
import Header from '@/components/template/Header'
import Menu from '@/components/template/Menu'
import Content from '@/components/template/Content'
import Footer from '@/components/template/Footer'
import axios from 'axios'
import { baseApiUrl, userKey } from '@/config/global'

export default {
  name: 'App',
  components: { Header, Menu, Content, Footer },
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'usuario']),
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
      this.$store.commit('setUsuario', null)
      this.$store.commit('setIsMenuVisible', false)

      if (!usuarioData) {
        this.validatingToken = false
        this.$store.commit('setIsMenuVisible', false)
        this.$router.push({ name: 'auth' })
        return
      }
      axios.defaults.headers.common.Authorization = `Bearer ${usuarioData.token}`
      const res = await axios.post(`${baseApiUrl}/auth/validateToken`)
      if (res.data.usuario) {
        localStorage.setItem(userKey, JSON.stringify(res.data.usuario))
        this.$store.commit('setUsuario', res.data.usuario)
        this.$store.commit('setIsMenuVisible', true)
        this.$store.commit('setIsConfigVisible', true)
        if (this.$mq === 'xs' || this.$mq === 'sm') {
          this.$store.commit('toggleMenu', false)
        }
      } else {
        localStorage.removeItem(userKey)
        this.$store.commit('setIsMenuVisible', false)
        this.$store.commit('setIsConfigVisible', false)
        this.$router.push({ name: 'auth' })
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
