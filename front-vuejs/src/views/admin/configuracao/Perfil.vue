<template>
    <div class="perfil">
        <b-form>
            <input type="hidden" v-model="perfil.id">
           <b-row>
              <b-col md="6" sm="12">
                <b-form-group label="Nome Usuario:" label-for="perfil-nome">
                    <b-form-input id="perfil-nome" type="text" placeholder="Nome do Usuário"
                    :readonly="true"
                    v-model="perfil.nome">
                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col md="6" sm="12">
                <b-form-group label="Senha:" label-for="perfil-senha">
                    <b-form-input id="perfil-senha" type="password" required placeholder="Senha do Usuário"
                    v-model="perfil.senha">

                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col md="6" sm="12">
                <b-form-group label="Confirmar Senha:" label-for="perfil-confirmar-senha">
                    <b-form-input id="perfil-confirmar-senha" type="password" required placeholder="Confirmacao de Senha"
                    v-model="perfil.confirmar">

                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col md="6" sm="12">
                <b-form-group label="Ramal do  Usuário:" label-for="perfil-ramal">
                    <b-form-input id="perfil-ramal" type="text" placeholder="Ramal do  Usuário"
                    v-model="perfil.ramal">

                    </b-form-input>
                </b-form-group>
            </b-col>
           </b-row>
             <hr>
        <b-row>
               <b-col class="btn-anotar" md="6" sm="12">
            <b-button variant="primary" :disabled="isDisabled"  @click="save"> Salvar </b-button>
               </b-col>
           </b-row>
        </b-form>
    </div>
</template>

<script>
import axios from 'axios'
import { baseApiUrl, showError, showSuccess, userKey } from '@/config/global'
import { mapState } from 'vuex'
export default {
  computed: mapState(['usuario']),
  data () {
    return {
      perfil: {
        nome: '',
        senha: '',
        isDisabled: false,
        confirmar: '',
        super: true,
        operacao: true,
        status: true,
        ramal: 0,
        udash: '000'
      }
    }
  },
  methods: {
    async save () {
      this.isDisabled = true
      if (this.perfil.senha !== this.perfil.confirmar) {
        showError('Senha não Confere')
        this.isDisabled = false
        return
      }
      await axios.put(`${baseApiUrl}/usuarios/criar/${this.usuario.id}`, this.perfil).then(res => {
        localStorage.removeItem(userKey)
        this.perfil = {}
        this.$store.commit('setUsuario', res.data.usuario)
        localStorage.setItem(userKey, JSON.stringify(this.$store.usuario))
        this.carregarPerfil()
        showSuccess(this.novoUsuario.message)
      }).catch(showError)
    },
    reset () {
      this.perfil = this.usuario
      this.isDisabled = false
    },
    carregarPerfil () {
      this.perfil.nome = this.usuario.nome
      this.perfil.super = (this.usuario.super === '0') ? 0 : 1
      this.perfil.operacao = this.usuario.operacao
      this.perfil.status = (this.usuario.status > 1) ? 1 : this.usuario.status
      this.perfil.ramal = this.usuario.ramal
      this.perfil.udash = this.usuario.udash
    }
  },
  mounted () {
    this.carregarPerfil()
  },
  created () {
    this.carregarPerfil()
  }
}
</script>

<style>

</style>
