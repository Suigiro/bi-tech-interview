<template>
  <div class="pacientes">
    <PageTitle icon='fa fa-users' main="Pacientes" sub="Saude Paciente" />
    <b-button variant="primary" @click="novo"> Novo Paciente </b-button>
    <div class="pacientes">
      <PageTitle icon='' main="" sub="Pacientes" destacar="true" />

       <b-form-input id="filter-input" v-model="filtroPacientes" type="search" placeholder="Digite aqui : Nome do Paciente"></b-form-input>
       <b-table  :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :filter="filtroPacientes"  @filtered="onFilteredPaciente" id="pacientes" hover striped :items="pacientes"  :fields="fieldsPacientes" :current-page="currentPage_paciente" :per-page="perPage_paciente" foot-clone no-footer-sorting>
        <template v-slot:cell(data_nasc)="data">
          <span>{{ data.item.data_nasc | formatDate }}</span>
       </template>
       <template v-slot:cell(action)="data">
          <b-link :to="`/formPaciente/${data.item.id}`" alt="Visualizar Paciente" ><i class="icon fa fa-eye"></i></b-link>
       </template>
       </b-table>

       <p class="mt-3">Pagina Atual: {{ currentPage_paciente }}</p>
       <b-col sm="12" md="6">
          <b-form-group
            label="Registros por Pagina"
            label-for="per-page-select"
            label-cols-sm="6"
            label-cols-md="3"
            label-align-sm="right"
            label-size="sm"
            class="mb-0"
          >
            <b-form-select
              id="per-page-select"
              v-model="perPage_paciente"
              :options="pagePacienteOptions"
              size="sm"
            ></b-form-select>
        </b-form-group>
        </b-col>
       <b-pagination v-model="currentPage_paciente" :total-rows="rows_paciente" :per-page="perPage_paciente" aria-controls="pacientes"></b-pagination>

    </div>
</div>
</template>

<script>
import PageTitle from '@/components/template/PageTitle'
import axios from 'axios'
import { baseApiUrl, showError, showSuccess } from '@/config/global'
import { mapState } from 'vuex'

export default {
  name: 'Atualizacoes',
  components: { PageTitle },
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'isLoading', 'usuario']),
  data () {
    return {
      mode: '',
      sortBy: 'id',
      sortDesc: false,
      atendimento: {},
      isDisabled: false,
      filtroPacientes: '',
      paciente: {},
      pacientes: [],
      currentPage_paciente: 1,
      rows_paciente: 0,
      perPage_paciente: 5,
      pagePacienteOptions: [5, 10, 15, { value: 100, text: 'Registros' }],
      fieldsPacientes: [
        { key: 'id', label: 'Id', sortable: true },
        { key: 'nome', label: 'Nome', sortable: true },
        { key: 'cpf', label: 'CPF', sortable: true },
        { key: 'celular', label: 'Celular', sortable: true },
        { key: 'data_nasc', label: 'Data de Nascimento', sortable: true },
        { key: 'action', label: '', sortable: false }
      ]
    }
  },
  methods: {
    async loadPacientes () {
      const url = `${baseApiUrl}/pacientes`
      const data = ''
      await axios.get(url, data).then(res => {
        this.pacientes = res.data.data
        this.$store.commit('setPacientes', res.data.data)
        this.rows_paciente = res.data.data.length
        this.pagePacienteOptions[3].value = res.data.data.length
        showSuccess('Solicitação realizada com sucesso', res.data.status)
      }).catch(function (error) {
        console.log(error)
      })
      this.$store.commit('setLoading', false)
    },
    novo () {
      this.$router.push({ name: 'formPaciente' })
    },

    loadPaciente (paciente, mode = 'novo') {
      this.mode = mode
      this.pacientes = { ...paciente }
    },
    onFilteredPaciente (paciente) {
      this.rows_paciente = paciente.length
      this.currentPage_paciente = 1
    },
    onContext (ctx) {
      this.paciente.data_nasc = ctx.selectedFormatted
      this.paciente.data_nasc = ctx.selectedYMD
    }
  },
  mounted () {
    this.$store.commit('setLoading', true)
    this.loadPacientes()
  },
  watch: {
    currentPage: {
      handler: function (value) {
        this.fetch().catch(error => {
          console.error(error)
        }).catch(showError)
      }
    }
  }
}
</script>

<style>
.pacientes #filter-input {
  background-color: rgba(0, 174, 255, 0.75);
}
.pacienteshr {
        border: 0;
        width: 100%;
        height: 1px;
        background-image: linear-gradient(to right,
            rgba(120,120,120,0),
            rgba(120,120,120,0.75),
            rgba(120,120,120,0));
}
td a, td a:hover
{
  color: #000;
  text-decoration: none;
}

hr {
        border: 0;
        width: 100%;
        height: 1px;
        background-image: linear-gradient(to right,
            rgba(120,120,120,0),
            rgba(120,120,120,0.75),
            rgba(120,120,120,0));
    }
.icon {
        display: flex;
        align-items: center;
        color:rgba(0, 174, 255, 0.75);
    }

  .icon i {
        font-size: 5rem;
    }
</style>
