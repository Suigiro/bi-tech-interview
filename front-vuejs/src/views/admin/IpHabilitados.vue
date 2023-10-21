<template>
<div class="ipsHabilitados">
   <b-form>
     <input type="hidden" id="ipsHabilitado-id" v-model="ipsHabilitado.id">
    <b-row>
        <b-col md="6" sm="12">
           <b-form-group label="Cliente:" label-for="ipsHabilitado-cliente">
             <b-form-input id="ipsHabilitado-cliente" type="text"
             :readonly="mode === 'remove'"
             v-model="ipsHabilitado.id" required placeholder="Identificação do Cliente">

             </b-form-input>
           </b-form-group>
        </b-col>
        <b-col md="6" sm="12">
           <b-form-group label="IP:" label-for="ipsHabilitado-ip">
             <b-form-input id="ipsHabilitado-ip" type="text"
             :readonly="mode === 'remove'"
             v-model="ipsHabilitado.ip" required placeholder="IP Habilitado">

             </b-form-input>
           </b-form-group>
        </b-col>
    </b-row>
    <b-button variant="primary"
    v-if="mode==='save'"
    @click="save">Salvar</b-button>
    <b-button variant="danger"
    v-if="mode==='remove'"
    @click="remove">Excluir</b-button>
    <b-button class="m-2" @click="reset">
      Cancelar
    </b-button>
  </b-form>
  <hr>
  <b-table id="ipsHabilitados" hover striped :items="ipsHabilitados"  :fields="fields" :current-page="currentPage" :per-page="perPage">
     <template v-slot:cell(numero)= "data">
      {{ data.index + 1}}
    </template>
    <template v-slot:cell(actions)= "data">
      <b-button variant="warning" @click="loadipHabilitado(data.item)" class='mr-2'>
        <i class="fa fa-pencil"></i>
      </b-button>
      <b-button variant="danger" @click="loadipHabilitado(data.item, 'remove')">
        <i class="fa fa-trash"></i>
      </b-button>
    </template>
  </b-table>
  <p class="mt-3">Pagina Atual: {{ currentPage }}</p>
     <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="ipsHabilitados"
    ></b-pagination>

</div>
</template>

<script>
import { baseApiUrl, showError } from '@/config/global'
import axios from 'axios'

export default {
  name: 'ipsHabilitados',
  data () {
    return {
      mode: 'save',
      ipsHabilitado: {},
      ipsHabilitados: [],
      currentPage: 1,
      rows: 1,
      perPage: 10,
      emptyText: 'Não existem dados na tabela',

      fields: [
        { key: 'numero', label: 'N°', sortable: true },
        { key: 'id', label: 'Cliente', sortable: true },
        { key: 'ip', label: 'IP', sortable: true },
        { key: 'actions', label: 'Ações' }
      ]
    }
  },
  methods: {
    loadipsHabilitados () {
      const url = `${baseApiUrl}/ipHabilitado/listar`
      axios.get(url).then(res => {
        this.ipsHabilitados = res.data.habilitados
        this.rows = res.data.records
      })
    },
    async fetch () {
      const next = `${baseApiUrl}/ipHabilitado/listar`
      await axios.get(next).then(res => {
        this.ipsHabilitados = res.data.habilitados
        this.rows = res.data.records
      })
    },
    async save () {
      const method = this.ipsHabilitado.id ? 'put' : 'post'
      const id = this.ipsHabilitado.id ? '/ipHabilitado/editar' : '/ipHabilitado/criar'
      axios[method](`${baseApiUrl}/${id}`, this.ipsHabilitado)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async remove () {
      axios.delete(`${baseApiUrl}/ipHabilitado/deletar`, this.ipsHabilitado)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async reset () {
      this.mode = 'save'
      this.ipsHabilitado = {}
      this.loadipHabilitado()
    },
    loadipHabilitado (ipsHabilitado, mode = 'save') {
      this.mode = mode
      this.ipsHabilitado = { ...ipsHabilitado }
    }
  },
  mounted () {
    this.loadipsHabilitados()
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
