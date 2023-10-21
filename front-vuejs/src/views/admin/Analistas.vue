<template>
  <div class="analistas">
    <b-form v-if="mode!==null">
       <input type="hidden" id="analista-id" v-model="formAnalista.Codigo">
          <b-row>
              <b-col md="12" sm="12">
              <b-form-group label="Nome Analista:" label-for="analista-nome">
                <b-form-input id="analista-nome" type="text" required placeholder="Nome do analista"
                  v-model="formAnalista.Nome">
                </b-form-input>
              </b-form-group>
              </b-col>
          </b-row>
    <b-row>
      <b-col class="btn-anotar" md="6" sm="12">
        <b-button variant="primary" v-if="mode==='save'" @click="save"> Salvar </b-button>
        <b-button variant="danger"  v-if="mode==='remove'" @click="remove"> Excluir </b-button>
        <b-button class="m-2" @click="reset"> Cancelar </b-button>
      </b-col>
    </b-row>
    </b-form>
    <b-button variant="primary" v-else @click="novo"> Novo Analista </b-button>
    <hr />

  <b-table id="analistas" hover striped :items="analistas"  :fields="fields" :current-page="currentPage" :per-page="perPage">
     <template v-slot:cell(actions)= "data">
        <b-button variant="warning" @click="loadanalista(data.item, 'save')" class='mr-2'>
          <i class="fa fa-pencil"></i>
        </b-button>
        <b-button variant="danger" @click="remove(data.item.Codigo)">
          <i class="fa fa-trash"></i>
        </b-button>
      </template>
  </b-table>

  <b-col sm="5" md="6">
        <b-form-group
          label="Registros por Pagina"
          label-for="per-page-select"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="per-page-select"
            v-model="perPage"
            :options="pageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>
       <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="usuarios"></b-pagination>
</div>
</template>

<script>
import axios from 'axios'
import { baseApiUrl, showError } from '@/config/global'
import { mapState } from 'vuex'

export default {
  name: 'analistas',
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'analista']),
  data () {
    return {
      mode: null,
      formAnalista: {},
      analistas: [],
      currentPage: 1,
      rows: 1,
      perPage: 10,
      pageOptions: [5, 10, 15, { value: 100, text: 'Registros' }],
      fields: [
        { key: 'Codigo', label: 'N°', sortable: true },
        { key: 'Nome', label: 'Nome', sortable: true },
        { key: 'actions', label: 'Ações' }
      ]
    }
  },
  methods: {
    async loadAnalistas () {
      const url = `${baseApiUrl}/analistas/listar`
      await axios.get(url).then(res => {
        this.analistas = res.data.analistas
        this.rows = res.data.records
      })
    },
    novo () {
      this.mode = 'save'
    },
    async fetch () {
      const next = `${baseApiUrl}/analistas/listar`
      await axios.get(next).then(res => {
        this.analistas = res.data.analistas
        this.rows = res.data.records
      })
    },
    async save () {
      const method = this.formAnalista.Codigo ? 'put' : 'post'
      const id = this.formAnalista.Codigo ? 'analistas/editar/' + this.formAnalista.Codigo : 'analistas/criar'
      this.formAnalista.modo = this.mode
      await axios[method](`${baseApiUrl}/${id}`, this.formAnalista)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
          this.loadAnalistas()
        }).catch(showError)
    },
    async remove (id) {
      const method = 'put'
      const url = 'analistas/deletar/' + id
      await axios[method](`${baseApiUrl}/${url}`)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
        }).catch(showError)
    },
    reset () {
      this.mode = null
      this.formAnalista = {}
      this.loadAnalistas()
    },
    loadanalista (analista, mode = 'save') {
      this.mode = mode
      this.formAnalista = { ...analista }
    }
  },
  mounted () {
    this.loadAnalistas()
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
