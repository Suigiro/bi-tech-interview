<template>
<div class="ipsDesconhecidos">
   <b-form>
     <input type="hidden" id="ipsDesconhecido-id" v-model="ipsDesconhecido.id">
    <b-row>
        <b-col md="6" sm="12">
           <b-form-group label="Cliente:" label-for="ipsDesconhecido-cliente">
             <b-form-input id="ipsDesconhecido-cliente" type="text"
             :readonly="mode === 'remove'"
             v-model="ipsDesconhecido.id" required placeholder="Identificação do Cliente">

             </b-form-input>
           </b-form-group>
        </b-col>
        <b-col md="6" sm="12">
           <b-form-group label="IP:" label-for="ipsDesconhecido-ip">
             <b-form-input id="ipsDesconhecido-ip" type="text"
             :readonly="mode === 'remove'"
             v-model="ipsDesconhecido.ip" required placeholder="IP Desconhecido">

             </b-form-input>
           </b-form-group>
        </b-col>
    </b-row>
    <b-row>
       <b-col md="6" sm="12">
        <b-button variant="primary"
        v-if="mode==='save'"
        @click="save">Salvar</b-button>
        <b-button variant="danger"
        v-if="mode==='remove'"
        @click="remove">Excluir</b-button>
        <b-button class="m-2" @click="reset">
          Cancelar
        </b-button>
        </b-col>
    </b-row>
  </b-form>
  <hr>
  <b-table id="ipsDesconhecidos" hover striped :items="ipsDesconhecidos"  :fields="fields" :current-page="currentPage" :per-page="perPage">
    <template v-slot:cell(numero)= "data">
      {{ data.index + 1}}
    </template>
    <template v-slot:cell(actions)= "data">
      <b-button variant="warning" @click="loadipDesconhecido(data.item)"  class='mr-2'>
        <i class="fa fa-pencil"></i>
      </b-button>
      <b-button variant="danger" @click="loadipDesconhecido(data.item, 'remove')">
        <i class="fa fa-trash"></i>
      </b-button>
    </template>
  </b-table>
  <p class="mt-3">Pagina Atual: {{ currentPage }}</p>
     <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="ipsDesconhecidos"

    ></b-pagination>

</div>
</template>

<script>
import { baseApiUrl, showError } from '@/config/global'
import axios from 'axios'

export default {
  name: 'ipsDesconhecidos',
  data () {
    return {
      mode: 'save',
      ipsDesconhecido: {},
      ipsDesconhecidos: [],
      currentPage: 1,
      rows: 1,
      perPage: 10,

      fields: [
        { key: 'numero', label: 'N°', sortable: true },
        { key: 'id', label: 'Cliente', sortable: true },
        { key: 'ip', label: 'IP', sortable: true },
        { key: 'actions', label: 'Ações' }
      ]
    }
  },
  methods: {
    loadipsDesconhecidos () {
      const url = `${baseApiUrl}/ipDesconhecido/listar `
      axios.get(url).then(res => {
        this.ipsDesconhecidos = res.data.desconhecidos
        this.rows = res.data.records
      })
    },
    async fetch () {
      const next = `${baseApiUrl}/ipDesconhecido/listar`
      await axios.get(next).then(res => {
        this.ipsDesconhecidos = res.data.desconhecidos
        this.rows = res.data.records
      })
    },
    async save () {
      const method = this.ipsDesconhecido.id ? 'put' : 'post'
      const id = this.ipsDesconhecido.id ? '/ipDesconhecido/editar' : '/ipDesconhecido/criar'
      axios[method](`${baseApiUrl}/${id}`, this.ipsDesconhecido)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async remove () {
      axios.delete(`${baseApiUrl}/ipDesconhecido/deletar`, this.ipsDesconhecido)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async reset () {
      this.mode = 'save'
      this.ipsBloqueado = {}
      this.loadipsDesconhecidos()
    },
    loadipDesconhecido (ipsDesconhecido, mode = 'save') {
      this.mode = mode
      this.ipsDesconhecido = { ...ipsDesconhecido }
    }
  },
  mounted () {
    this.loadipsDesconhecidos()
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
