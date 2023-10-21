<template>
<div class="consolidados">
  <b-table id="consolidados" hover striped :items="consolidados"  :fields="fields" :current-page="currentPage" :per-page="perPage"></b-table>
  <p class="mt-3">Pagina Atual: {{ currentPage }}</p>
     <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="consolidados"

    ></b-pagination>

</div>
</template>

<script>
import { baseApiUrl } from '@/config/global'
import axios from 'axios'

export default {
  name: 'consolidados',
  data () {
    return {
      mode: 'save',
      consolidado: {},
      consolidados: [],
      currentPage: 1,
      rows: 1,
      perPage: 10,

      fields: [
        { key: 'numero', label: 'N°', sortable: true },
        { key: 'sistema', label: 'Cliente', sortable: true },
        { key: 'programa', label: 'Programa', sortable: true },
        { key: 'rotina', label: 'Rotina', sortable: true },
        { key: 'linha', label: 'Linha', sortable: true },
        { key: 'numero', label: 'Número', sortable: true },
        { key: 'descricao', label: 'Descrição', sortable: true },
        { key: 'qtde', label: 'Qtde', sortable: true },
        { key: 'ultdata', label: 'Ult.Data', sortable: true },
        { key: 'mantis', label: 'MANTIS', sortable: true }
      ]
    }
  },
  methods: {
    loadconsolidados () {
      const url = `${baseApiUrl}/clientes/consolidado`
      axios.get(url).then(res => {
        this.consolidados = res.data.consolidado
        this.rows = res.data.records
      })
    },
    async fetch () {
      const next = `${baseApiUrl}/clientes/consolidado`
      await axios.get(next).then(res => {
        this.consolidados = res.data.consolidado
        this.rows = res.data.records
      })
    }
  },
  mounted () {
    this.loadconsolidados()
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
