<template>
      <div class="formPacientes">
        <PageTitle icon='fa fa-users' main="Pacientes" sub="Saude Paciente" />
        <b-form @submit="save">
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
              placeholder="DD/MM/AAAA"
              required>
              </b-form-datepicker>
           </b-form-group>
          </b-col>
        <b-col md="3" sm="12">
           <b-form-group label="Sexo Biológico:" label-for="sexo">
              <b-form-select id="sexo" required :options="sexoOption" v-model="paciente.sexo" ></b-form-select>
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
              <b-form-textarea id="descricao" placeholder="Descrição" v-model="paciente.descricao"></b-form-textarea>
           </b-form-group>
          </b-col>
        </b-row>

        <hr>
        <b-row>
          <b-col class="btn-anotar" md="6" sm="12">
            <b-button type='submit' variant="primary"> Salvar </b-button>
            <b-button variant="danger" class="m-2" v-if="id" @click="remover"> Excluir </b-button>
          </b-col>
        </b-row>
        </b-form>
      </div>
</template>
<script>
import PageTitle from '@/components/template/PageTitle'
import axios from 'axios'
import { baseApiUrl, showError, showSuccess } from '@/config/global'
import { mapState } from 'vuex'

export default {
  name: 'FormPaciente',
  props: ['id'],
  components: { PageTitle },
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'isLoading', 'usuario']),
  data () {
    return {
      mode: 'inserir',
      paciente: {
        nome: '',
        cpf: '',
        rg: '',
        data_nasc: '',
        sexo: '',
        celular: '',
        email: '',
        descricao: ''
      },
      sexoOption: [
        { value: null, text: 'Selecione' },
        { value: 'Feminino', text: 'Feminino' },
        { value: 'Masculino', text: 'Masculino' }
      ]
    }
  },
  methods: {
    async getPaciente () {
      axios.get(`${baseApiUrl}/paciente/${this.id}`).then(res => {
        this.paciente = res.data.data
      }).catch(function (error) {
        showError(error)
      })
      this.$store.commit('setLoading', false)
    },
    async save () {
      event.preventDefault()
      this.$store.commit('setLoading', true)
      const url = `${baseApiUrl}/paciente`
      const data = this.paciente
      if (!this.id) {
        await axios.post(url, data).then(res => {
          this.reset(res.data.data)
          showSuccess('Solicitação realizada com sucesso', res.data.status)
        }).catch(function (error) {
          showError(error)
        })
        this.$store.commit('setLoading', false)
        this.$router.push({ name: 'pacientes' })
      } else {
        await axios.put(`${url}/${this.id}`, data).then(res => {
          this.reset(res.data.data)
          showSuccess('Solicitação realizada com sucesso', res.data.status)
        }).catch(function (error) {
          showError(error)
        })
        this.$store.commit('setLoading', false)
        // this.$router.push({ name: 'pacientes' })
      }
    },
    async remover () {
      const url = `${baseApiUrl}/paciente`
      this.$store.commit('setLoading', true)
      await axios.delete(`${url}/${this.id}`).then(res => {
        showSuccess('Solicitação realizada com sucesso', res.data.status)
      }).catch(function (error) {
        showError(error)
      })
      this.$store.commit('setLoading', false)
      this.$router.push({ name: 'pacientes' })
    },
    reset (data) {
      this.paciente = data
    }
  },
  created () {
    if (this.id) {
      this.$store.commit('setLoading', true)
      this.getPaciente()
    }
  }
}
</script>
