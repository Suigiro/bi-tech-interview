<template>
  <div class="home">
    <PageTitle icon="fa fa-home" main="Dashboard" sub="Saude Paciente" />
    <div class="numeros_container">
      <Numeros title="Total de Pacientes" :value="pacientes"
      icon="fa fa-folder" color="#d54d50" />
    </div>
   </div>
</template>

<script>
import PageTitle from '@/components/template/PageTitle'
import Numeros from '@/components/dashboard/Numeros'
import axios from 'axios'
import { baseApiUrl, showError } from '@/config/global'
import { mapState } from 'vuex'

export default {
  name: 'Home',
  components: { PageTitle, Numeros },
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'isLoading', 'usuario']),
  data () {
    return {
      pacientes: 0
    }
  },
  methods: {
    async getNumeros () {
      await axios.get(`${baseApiUrl}/total`).then(res => {
        this.pacientes = res.data.data
      }).catch(function (error) {
        showError(error)
      })
      this.$store.commit('setLoading', false)
    }
  },
  mounted () {
    this.$store.commit('setLoading', true)
    this.getNumeros()
  }
}
</script>

<style>
.numeros_container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
</style>
