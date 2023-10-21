<template>
<div class="ipsBloqueados">
   <b-form>
     <input type="hidden" id="ipsBloqueado-id" v-model="ipsBloqueado.id">
    <b-row>
        <b-col md="6" sm="12">
           <b-form-group label="Cliente:" label-for="ipsBloqueado-cliente">
             <b-form-input id="ipsBloqueado-cliente"
             :readonly="mode === 'remove'"
             type="text"
             v-model="ipsBloqueado.id" required placeholder="Identificação do Cliente">

             </b-form-input>
           </b-form-group>
        </b-col>
        <b-col md="6" sm="12">
           <b-form-group label="IP:" label-for="ipsBloqueado-ip">
             <b-form-input id="ipsBloqueado-ip" type="text"
             :readonly="mode === 'remove'"
             v-model="ipsBloqueado.ip" required placeholder="IP Bloqueado">

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
  <b-table id="ipsBloqueados" hover striped :items="ipsBloqueados"  :fields="fields" :current-page="currentPage" :per-page="perPage">
    <template v-slot:cell(numero)= "data">
      {{ data.index + 1}}
    </template>
    <template v-slot:cell(actions)= "data">
      <b-button variant="warning" @click="loadipBloqueado(data.item)"  class='mr-2'>
        <i class="fa fa-pencil"></i>
      </b-button>
      <b-button variant="danger" @click="loadipBloqueado(data.item, 'remove')">
        <i class="fa fa-trash"></i>
      </b-button>
    </template>
  </b-table>
  <p class="mt-3">Pagina Atual: {{ currentPage }}</p>
     <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="ipsBloqueados"

    ></b-pagination>

</div>
</template>

<script>
import { baseApiUrl, showError } from '@/config/global'
import axios from 'axios'

export default {
  name: 'ipsBloqueados',
  data () {
    return {
      mode: 'save',
      ipsBloqueado: {},
      ipsBloqueados: [],
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
    loadipsBloqueados () {
      const url = `${baseApiUrl}/ipBloqueado/listar `
      axios.get(url).then(res => {
        this.ipsBloqueados = res.data.bloqueados
        this.rows = res.data.records
      }).catch(showError)
    },
    async fetch () {
      const next = `${baseApiUrl}/ipBloqueado/listar`
      await axios.get(next).then(res => {
        this.ipsBloqueados = res.data.bloqueados
        this.rows = res.data.records
      }).catch(showError)
    },
    async save () {
      const method = this.ipsBloqueado.id ? 'put' : 'post'
      const id = this.ipsBloqueado.id ? '/ipBloqueado/editar' : '/ipBloqueado/criar'
      axios[method](`${baseApiUrl}/${id}`, this.ipsBloqueado)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async remove () {
      axios.delete(`${baseApiUrl}/ipBloqueado/deletar`, this.ipsBloqueado)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    async reset () {
      this.mode = 'save'
      this.ipsBloqueado = {}
      this.loadipsBloqueados()
    },
    loadipBloqueado (ipsBloqueado, mode = 'save') {
      this.mode = mode
      this.ipsBloqueado = { ...ipsBloqueado }
    }
  },
  mounted () {
    this.loadipsBloqueados()
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
