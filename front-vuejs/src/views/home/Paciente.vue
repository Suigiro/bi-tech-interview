<template>
  <div class="pacientes">
    <PageTitle icon='fa fa-users' main="Pacientes" sub="Saude Paciente" />
    <div class="aguardando">
      <b-form v-if="mode==='novo'">
       <b-row>
           <b-col md="4" sm="12">
            <b-form-group label="Nome completo:" label-for="nome">
              <b-form-input id="nome" type="text" required placeholder="Nome completo"
               v-model="paciente.nome"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="4" sm="12">
            <b-form-group label="CPF:" label-for="cpf">
              <b-form-input  id="cpf" type="text" required placeholder="000.000.000-00"
               v-model="paciente.cpf" v-mask="'###.###.###-##'"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="4" sm="12">
            <b-form-group label="RG:" label-for="rg">
              <b-form-input  id="rg" type="text" required placeholder="00.000.000-0"
               v-model="paciente.rg" v-mask="'##.####.####-#'"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>

         <b-col md="3" sm="12">
            <b-form-group label="Data de nascimento:" label-for="data_nasc">
              <b-form-datepicker
              id="data_nasc"
              size="sm"
              locale="pt-BR"
              class="mb-2"
              :date-format-options="{ day: 'numeric', month: 'numeric', year: 'numeric' }"
              v-model="paciente.data_nasc"
              placeholder="DD/MM/AAAA">
              </b-form-datepicker>
           </b-form-group>
          </b-col>
        <b-col md="3" sm="12">
           <b-form-group label="Sexo Biológico:" label-for="sexo">
              <v-select required :options="sexoOption" v-model="paciente.sexo" :reduce="sexoOption=>sexoOption.label"  ></v-select>
           </b-form-group>
        </b-col>
           <b-col md="3" sm="12">
            <b-form-group label="Celular:" label-for="celular">
                <b-form-input  id="celular" type="text" required placeholder="(00) 00000-0000"
               v-model="paciente.celular" v-mask="'(##)#####-####'"></b-form-input>
            </b-form-group>
          </b-col>
            <b-col md="3" sm="12">
            <b-form-group label="E-mail:" label-for="email">
                <b-form-input  id="email" type="email" required placeholder="teste@teste.com"
               v-model="paciente.email" ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
         <b-row>
          <b-col md="12" sm="12">
            <b-form-group label="Descrição:" label-for="descricao">
              <b-form-textarea id="descricao" placeholder="Descrição" required v-model="paciente.descricao"></b-form-textarea>
           </b-form-group>
          </b-col>
        </b-row>
        </b-form>
        <hr>
        <b-row>
          <b-col class="btn-anotar" md="6" sm="12">
            <b-button variant="primary" :disabled="isDisabled" v-if="mode==='novo'" @click="save"> Salvar </b-button>
            <b-button variant="primary"  v-if="mode!=='novo'" @click="abrir"> Novo Paciente </b-button>
            <b-button class="m-2" v-if="mode==='novo'" @click="reset"> Cancelar </b-button>
          </b-col>
        </b-row>
      <hr>
      <PageTitle icon='' main="" sub="Pacientes" destacar="true" />

       <b-form-input id="filter-input" v-model="filtroPacientes" type="search" placeholder="Digite aqui : Nome do Paciente"></b-form-input>
       <b-table  :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :filter="filtroPacientes"  @filtered="onFilteredPaciente" id="pacientes" hover striped :items="pacientes"  :fields="fieldsPacientes" :current-page="currentPage_paciente" :per-page="perPage_paciente" foot-clone no-footer-sorting>
       <template v-slot:cell(action)="data">
          <b-link :to="`/verPaciente/${data.item.id}`" alt="Visualizar Paciente" ><i class="icon fa fa-eye"></i></b-link>
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
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'usuario']),
  data () {
    return {
      mode: '',
      sortBy: 'nome',
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
      sexoOption: [
        { value: null, text: 'Selecione' },
        { value: 'Feminino', text: 'Feminino' },
        { value: 'Masculino', text: 'Masculino' }
      ],
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
        console.log(this.pacientes)
        this.rows_paciente = res.data.length
        this.pageAguardandoOptions[3].value = res.data.length
      }).catch(showError)
    },
    abrir () {
      this.mode = 'novo'
      this.paciente = {}
      this.loadPaciente(this.paciente, 'novo')
    },
    save () {
      this.isDisabled = true
      const url = `${baseApiUrl}/paciente`
      const data = this.paciente
      axios.post(url, data).then(res => {
        showSuccess('Solicitação realizada com sucesso', res.status)
        this.reset()
      }).catch(showError)

      this.isDisabled = false
    },
    reset () {
      this.isDisabled = false
      this.mode = 'paciente'
      this.paciente = {}
      this.loadPaciente(this.paciente, 'paciente')
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
