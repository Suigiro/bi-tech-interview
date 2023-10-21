<template>
  <div class="pacientes">
    <PageTitle icon='fa fa-ticket' main="Atendimentos" sub="Udash - Chamados" />
    <div class="aguardando">
      <b-form v-if="mode==='novo'">
        <b-row>
          <b-col md="12" sm="12">
            <b-form-group label="Clientes:" label-for="atendimento-novo-cliente">
              <v-select required :options="clienteOption" v-model="atendimento.cliente" :reduce="clienteOption=>clienteOption.label"></v-select>
           </b-form-group>
          </b-col>
            </b-row>
        <b-row>
           <b-col md="4" sm="12">
            <b-form-group label="Nome de Contato:" label-for="atendimento-novo-nome_contato">
              <b-form-input id="atendimento-novo-nome_contato" type="text" required placeholder="Nome de contato"
               v-model="atendimento.nome_contato"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="4" sm="12">
            <b-form-group label="E-mail de Contato:" label-for="atendimento-novo-email_contato">
              <b-form-input  id="atendimento-novo-email_contato" type="email" required placeholder="E-mail de contato"
               v-model="atendimento.email_contato"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="4" sm="12">
            <b-form-group label="Telefone de Contato:" label-for="atendimento-novo-fone_contato">
              <b-form-input  id="atendimento-novo-fone_contato" type="text" required placeholder="Telefone de Contato"
               v-model="atendimento.fone_contato" v-mask="'(##) #####-####'"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col md="12" sm="12">
            <b-form-group label="Descrição:" label-for="atendimento-novo-descricao">
              <b-form-textarea id="atendimento-novo-descricao" placeholder="Descrição do Chamado" required v-model="atendimento.descricao"></b-form-textarea>
           </b-form-group>
          </b-col>
        </b-row>
        <b-row>
           <b-col md="4" sm="12">
           <b-form-group label="Analista:" label-for="atendimento-novo-analista">
              <v-select required :options="analistaOption" v-model="atendimento.analista" :reduce="analistaOption=>analistaOption.label"></v-select>
           </b-form-group>
        </b-col>
         <b-col md="4" sm="12">
            <b-form-group label="Motivo:" label-for="atendimento-novo-motivo">
              <v-select required :options="optionsMotivo" v-model="atendimento.motivo" :reduce="optionsMotivo=>optionsMotivo.label"></v-select>
           </b-form-group>
          </b-col>
           <b-col md="4" sm="12">
            <b-form-group label="Programa:" label-for="atendimento-novo-programa">
                <b-form-input  id="atendimento-novo-programa" type="text" required placeholder="Adicionar Programa"
               v-model="atendimento.programa"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
           <b-col md="6" sm="12">
            <b-form-group label="Sistema:" label-for="atendimento-novo-sistema">
              <v-select required :options="sistemaOption" v-model="atendimento.sistema" :reduce="sistemaOption=>sistemaOption.label"></v-select>
            </b-form-group>
          </b-col>
        </b-row>
        </b-form>
        <hr>
        <b-row>
          <b-col class="btn-anotar" md="6" sm="12">
            <b-button variant="primary" :disabled="isDisabled" v-if="mode==='novo'" @click="save"> Salvar </b-button>
            <b-button variant="danger"  v-if="mode==='aguardando'" @click="abrir"> Abrir Novo Chamado </b-button>
            <b-button class="m-2" v-if="mode==='novo'" @click="reset"> Cancelar </b-button>
          </b-col>
        </b-row>
      <hr>
      <PageTitle icon='' main="" sub="AGUARDANDO ATENDIMENTO" destacar="true" />

       <b-form-input id="filter-input" v-model="filtroAguardando" type="search" placeholder="Digite aqui : Nome do Cliente"></b-form-input>
       <b-table  :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :filter="filtroAguardando"  @filtered="onFilteredAguardando" id="agurdando-atendimento" hover striped :items="aguardando"  :fields="fieldsAguardando" :current-page="currentPage_aguardando" :per-page="perPage_aguardando" foot-clone no-footer-sorting>
        <template v-slot:cell(id)="data">
          <b-link :to="`/verchamado/${data.item.id}`" :alt="data.item.razao" >{{ data.item.id }}</b-link>
       </template>
       <template v-slot:cell(razao)="data">
          <b-link :to="`/vercliente/${data.item.id}`" :alt="data.item.razao" >{{ data.item.razao }}</b-link>
       </template>
       </b-table>

       <p class="mt-3">Pagina Atual: {{ currentPage_aguardando }}</p>
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
              v-model="perPage_aguardando"
              :options="pageAguardandoOptions"
              size="sm"
            ></b-form-select>
        </b-form-group>
        </b-col>
       <b-pagination v-model="currentPage_aguardando" :total-rows="rows_aguardando" :per-page="perPage_aguardando" aria-controls="agurdando-atendimento"></b-pagination>

    </div>
    <hr />
    <div class="em-atendimento">
      <PageTitle icon='' main="" sub="EM ATENDIMENTO" destacar="true" />
       <b-form-input id="filter-input" v-model="filtroAtendimento" type="search" placeholder="Digite aqui : Digite aqui : Nome do Cliente"></b-form-input>

       <b-table :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :filter='filtroAtendimento' @filtered="onFilteredAtendimento" id="em-atendimento" hover striped :items="atendimentos"  :fields="fieldsAtendimento" :current-page="currentPage_atendimento" :per-page="perPage_atendimento" foot-clone no-footer-sorting >
        <template v-slot:cell(id)="data">
          <b-link :to="`/verchamado/${data.item.id}`" :alt="data.item.razao" >{{ data.item.id }}</b-link>
       </template>
       <template v-slot:cell(razao)="data">
          <b-link :to="`/vercliente/${data.item.id}`" :alt="data.item.razao" >{{ data.item.razao }}</b-link>
       </template>
        <template v-slot:cell(mantis)="data" >
            <div :style='getClass(data.item.status)'>
              <b-link :href="`http://condonow.com.br/cliente/mantisbt/view.php?id=${data.item.mantis}`" :alt="data.item.mantis" target="_blank" >{{ data.item.mantis }}</b-link>
            </div>
        </template>
       </b-table>

       <p class="mt-3">Pagina Atual: {{ currentPage_atendimento }}</p>
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
            v-model="perPage_atendimento"
            :options="pageAtendimentoOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>
       <b-pagination v-model="currentPage_atendimento" :total-rows="rows_atendimento" :per-page="perPage_atendimento" aria-controls="em-atendimento"></b-pagination>
    </div>
    <hr />
    <div class="em-desenvolvimento">
      <PageTitle icon='' main="" sub="EM DESENVOLVIMENTO" destacar="true" />
       <b-form-input id="filter-input" v-model="filtroDesenvolvimento" type="search" placeholder="Digite aqui : Digite aqui : Nome do Cliente"></b-form-input>

       <b-table :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :filter='filtroDesenvolvimento' @filtered="onFilteredDesenvolvimento" id="em-desenvolvimento" hover striped :items="desenvolvimentos"  :fields="fieldsDesenvolvimento" :current-page="currentPage_desenvolvimentos" :per-page="perPage_desenvolvimentos" foot-clone no-footer-sorting >
        <template v-slot:cell(id)="data">
          <b-link :to="`/verchamado/${data.item.id}`" :alt="data.item.razao" >{{ data.item.id }}</b-link>
       </template>
       <template v-slot:cell(razao)="data">
          <b-link :to="`/vercliente/${data.item.id}`" :alt="data.item.razao" >{{ data.item.razao }}</b-link>
       </template>
        <template v-slot:cell(mantis)="data" >
            <div :style='getClass(data.item.status)'>
              <b-link :href="`http://condonow.com.br/cliente/mantisbt/view.php?id=${data.item.mantis}`" :alt="data.item.mantis" target="_blank" >{{ data.item.mantis }}</b-link>
            </div>
        </template>
       </b-table>

       <p class="mt-3">Pagina Atual: {{ currentPage_desenvolvimentos }}</p>
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
            v-model="perPage_desenvolvimentos"
            :options="pageDesenvolvimentoOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>
       <b-pagination v-model="currentPage_desenvolvimentos" :total-rows="rows_desenvolvimentos" :per-page="perPage_desenvolvimentos" aria-controls="em-desenvolvimento"></b-pagination>
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
      mode: 'aguardando',
      sortBy: 'razao',
      sortDesc: false,
      atendimento: {},
      isDisabled: false,
      filtroPacientes: '',
      paciente: [],
      pacientes: [],
      currentPage_paciente: 1,
      rows_paciente: 0,
      perPage_paciente: 5,
      pagePacienteOptions: [5, 10, 15, { value: 100, text: 'Registros' }],
      fieldsAguardando: [
        { key: 'id', label: 'Id', sortable: true },
        { key: 'nome', label: 'Nome', sortable: true },
        { key: 'cpf', label: 'CPF', sortable: true },
        { key: 'celular', label: 'Celular', sortable: true },
        { key: 'data_nasc', label: 'Data de Nascimento', sortable: true }
      ]
    }
  },
  methods: {
    loadAtendimentos () {
      const url = `${baseApiUrl}/pacientes`
      const data = ''
      axios.get(url, data).then(res => {
        this.aguardando = res.data
        this.rows_aguardando = res.data.length
        this.pageAguardandoOptions[3].value = res.data.length
      }).catch(showError)
    },
    async fetch () {
      const url = `${baseApiUrl}/atendimento/aguardando`
      const data = ''
      await axios.get(url, data).then(res => {
        this.aguardando = res.data.aguardando
      }).catch(showError)
    },
    abrir () {
      this.mode = 'novo'
      this.paciente = {}
      this.loadAtendimento(this.paciente, 'novo')
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
      this.loadAtendimento(this.paciente, 'paciente')
    },
    loadAtendimento (paciente, mode = 'novo') {
      this.mode = mode
      this.pacientes = { ...paciente }
    },
    onFilteredPaciente (paciente) {
      this.rows_paciente = paciente.length
      this.currentPage_paciente = 1
    }
  },
  mounted () {
    this.loadAtendimentos()
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
.atendimentos #filter-input {
  background-color: rgba(0, 174, 255, 0.75);
}
.atendimentoshr {
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

</style>
