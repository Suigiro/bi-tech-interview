import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isLoading: false,
    isMenuVisible: false,
    usuario: null,
    pacientes: null,
    isConfigVisible: false,
    isAdmin: false
  },
  mutations: {
    toggleMenu (state, isVisible) {
      if (!state.usuario) {
        state.isMenuVisible = false
        return
      }
      if (isVisible === undefined) {
        state.isMenuVisible = !state.isMenuVisible
      } else {
        state.isMenuVisible = isVisible
      }
    },
    setUsuario (state, usuario) {
      state.usuario = usuario
      if (usuario) {
        axios.defaults.headers.common.Authorization = `Bearer ${usuario.token}`
        state.isMenuVisible = true
        state.isAdmin = (usuario.super === 1)
      } else {
        axios.defaults.headers.common.Authorization = ''
        state.isMenuVisible = false
      }
    },
    setLoading (state, isLoading) {
      state.isLoading = isLoading
    },
    setPacientes (state, pacientes) {
      state.pacientes = pacientes
    },
    setIsMenuVisible (state, status) {
      state.isMenuVisible = status
    },
    setIsConfigVisible (state, status) {
      state.isConfigVisible = status
    },
    getPacientes (state) {
      return state.pacientes
    },
    getPacienteById (state, id) {
      return state.pacientes.find(paciente => paciente.id === id)
    }
  }
})
