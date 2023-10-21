<template>
<div class="atualizacoes">
  <b-table id="atualizacoes" hover striped :items="atualizacoes"  :fields="fields" :current-page="currentPage" :per-page="perPage">
     <template v-slot:cell(numero)= "data">
      {{ data.index + 1 }}
    </template>
  </b-table>
  <p class="mt-3">Pagina Atual: {{ currentPage }}</p>
     <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="atualizacoes"

    ></b-pagination>

</div>
</template>

<script>
import { baseApiUrl, showError } from '@/config/global'
import axios from 'axios'

export default {
  name: 'Atualizacoes',
  data () {
    return {
      mode: 'save',
      atualizacao: {},
      atualizacoes: [],
      currentPage: 1,
      rows: 1,
      perPage: 10,

      fields: [
        { key: 'numero', label: 'N°', sortable: true },
        { key: 'id', label: 'Cliente', sortable: true },
        { key: 'versaodb', label: 'Versao BD', sortable: true },
        { key: 'ip', label: 'IP', sortable: true },
        { key: 'data', label: 'Data', sortable: true },
        { key: 'ult_atualizacao', label: 'Atualização BD', sortable: true },
        { key: 'conpag', label: 'CONPAG', sortable: true },
        { key: 'loca', label: 'LOCAÇÃO', sortable: true },
        { key: 'condo', label: 'CONDO', sortable: true },
        { key: 'front', label: 'FRONT', sortable: true },
        { key: 'qtd_erros', label: 'Qtde. Erros', sortable: true }
      ]
    }
  },
  methods: {
    loadAtualizacoes () {
      const url = `${baseApiUrl}/clientes/ver`
      axios.get(url).then(res => {
        this.atualizacoes = res.data.clientes
        this.rows = res.data.records
      })
    },
    async fetch () {
      const next = `${baseApiUrl}/clientes/ver`
      await axios.get(next).then(res => {
        this.atualizacoes = res.data.clientes
        this.rows = res.data.records
      })
    },
    async save () {
      const method = this.ipsHabilitado.id ? 'put' : 'post'
      const id = this.ipsHabilitado.id ? '/clientes/editar' : '/clientes/criar'
      axios[method](`${baseApiUrl}/${id}`, this.ipsHabilitado)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async remove () {
      axios.delete(`${baseApiUrl}/clientes/deletar`, this.ipsHabilitado)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async reset () {
      this.mode = 'save'
      this.atualizacao = {}
      this.loadAtualizacoes()
    },
    loadAtualizacao (atualizacao, mode = 'save') {
      this.mode = mode
      this.atualizacao = { ...atualizacao }
    }
  },
  mounted () {
    this.loadAtualizacoes()
  },
  watch: {
    currentPage: {
      handler: function (value) {
        this.fetch().catch(error => {
          console.error(error)
        })
      }
    }
  }
}
</script>

<style>

</style>
