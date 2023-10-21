<template>
  <div class="usuarios">
    <b-form v-if="mode!==null">
       <input type="hidden" id="usuario-id" v-model="formUsuario.id">
          <b-row>
            <b-col md="4" sm="12">
              <b-form-group label="Nome Usuario:" label-for="usuario-nome">
                <b-form-input id="usuario-nome" type="text" required placeholder="Nome do Usuario"
                  v-model="formUsuario.nome">
                </b-form-input>
              </b-form-group>
            </b-col>
              <b-col md="4" sm="12">
              <b-form-group label="Senha Usuario:" label-for="usuario-senha">
                <b-form-input id="usuario-senha" type="text" required placeholder="Senha do Usuario"
                  v-model="formUsuario.senha">
                </b-form-input>
              </b-form-group>
            </b-col>
              <b-col md="4" sm="12">
              <b-form-group label="Confirmar Senha:" label-for="usuario-confirme">
                <b-form-input id="usuario-confirme" type="text" required placeholder="Confirmar Senha"
                  v-model="formUsuario.confirme">
                </b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
          <b-row>
            <b-col md="4" sm="12">
              <b-form-group label="Super Usuario:" label-for="usuario-super">
                <b-form-checkbox id="usuario-super" v-model="formUsuario.super" value="1" unchecked-value="0">
                </b-form-checkbox>
              </b-form-group>
            </b-col>
              <b-col md="4" sm="12">
              <b-form-group label="Operação:" label-for="usuario-operacao">
                 <b-form-checkbox id="usuario-operacao" v-model="formUsuario.operacao" value="1" unchecked-value="0">
                </b-form-checkbox>
              </b-form-group>
            </b-col>
              <b-col md="4" sm="12">
              <b-form-group label="Status:" label-for="usuario-status">
                 <b-form-checkbox id="usuario-status" v-model="formUsuario.status" value="1" unchecked-value="0">
                </b-form-checkbox>
              </b-form-group>
            </b-col>
          </b-row>
          <b-row>
            <b-col md="6" sm="12">
              <b-form-group label="Ramal Usuario:" label-for="usuario-ramal">
                <b-form-input id="usuario-ramal" type="text" v-model="formUsuario.ramal" required>
                </b-form-input>
              </b-form-group>
            </b-col>
              <b-col md="6" sm="12">
              <b-form-group label="Udash:" label-for="usuario-udash">
                 <b-form-input id="usuario-operacao" type="text" v-model="formUsuario.operacao" required>
                </b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
    <b-row>
      <b-col class="btn-anotar" md="6" sm="12">
        <b-button variant="primary" v-if="mode==='save'" @click="save"> Salvar </b-button>
        <b-button variant="danger"  v-if="mode==='remove'" @click="remove()"> Excluir </b-button>
        <b-button class="m-2" @click="reset"> Cancelar </b-button>
      </b-col>
    </b-row>
    </b-form>
    <b-button variant="primary" v-else @click="novo"> Novo Usuário </b-button>
    <hr />

  <b-table id="usuarios" hover striped :items="usuarios"  :fields="fields" :current-page="currentPage" :per-page="perPage">
     <template v-slot:cell(actions)= "data">
        <b-button variant="warning" @click="loadUsuario(data.item, 'save')" class='mr-2'>
          <i class="fa fa-pencil"></i>
        </b-button>
        <b-button variant="danger" @click="remove(data.item.id)">
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
  name: 'usuarios',
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'usuario']),
  data () {
    return {
      mode: null,
      formUsuario: {},
      usuarios: [],
      currentPage: 1,
      rows: 1,
      perPage: 10,
      pageOptions: [5, 10, 15, { value: 100, text: 'Registros' }],
      fields: [
        { key: 'id', label: 'N°', sortable: true },
        { key: 'nome', label: 'Nome', sortable: true },
        { key: 'super', label: 'Super', sortable: true, formatter: value => value ? 'Ativo' : 'Inativo' },
        { key: 'operacao', label: 'Operação', sortable: true, formatter: value => value ? 'Ativo' : 'Inativo' },
        { key: 'status', label: 'Status', sortable: true, formatter: value => value === 1 ? 'Ativo' : value === 2 ? 'Removido' : 'Inativo' },
        { key: 'ramal', label: 'Ramal', sortable: true },
        { key: 'udash', label: 'Udash', sortable: true },
        { key: 'actions', label: 'Ações' }
      ]
    }
  },
  methods: {
    async loadusuarios () {
      const url = `${baseApiUrl}/usuarios/listar`
      await axios.get(url).then(res => {
        this.usuarios = res.data.usuarios
        this.rows = res.data.records
      })
    },
    novo () {
      this.mode = 'save'
    },
    async fetch () {
      const next = `${baseApiUrl}/usuarios/listar`
      await axios.get(next).then(res => {
        this.usuarios = res.data.usuarios
        this.rows = res.data.records
      })
    },
    async save () {
      const method = this.formUsuario.id ? 'put' : 'post'
      const id = this.formUsuario.id ? 'usuarios/editar/' + this.formUsuario.id : 'usuarios/criar'
      this.formUsuario.modo = this.mode
      axios[method](`${baseApiUrl}/${id}`, this.formUsuario)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
          this.getAtendimetos()
        }).catch(showError)
    },
    async remove (id) {
      const method = 'put'
      const url = 'usuarios/deletar/' + id
      axios[method](`${baseApiUrl}/${url}`)
        .then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
          this.loadusuarios()
        }).catch(showError)
    },
    reset () {
      this.mode = null
      this.formUsuario = {}
      this.loadusuarios()
    },
    loadUsuario (usuario, mode = 'save') {
      this.mode = mode
      this.formUsuario = { ...usuario }
    }
  },
  mounted () {
    this.loadusuarios()
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
