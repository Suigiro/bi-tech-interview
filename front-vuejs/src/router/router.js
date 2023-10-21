import Vue from 'vue'
import VueRouter from 'vue-router'
import Auth from '@/views/auth/Auth'
import AdminPages from '@/views/admin/AdminPages'
import Configuracao from '@/views/admin/Configuracao'
import Home from '@/views/home/Home'
import Paciente from '@/views/home/Paciente'
import FormPaciente from '@/views/home/FormPaciente'
import { userKey } from '@/config/global'
Vue.use(VueRouter)

const routes = [{
  name: 'auth',
  path: '/',
  component: Auth
}, {
  name: 'home',
  path: '/home',
  component: Home
}, {
  name: 'pacientes',
  path: '/pacientes',
  component: Paciente
}, {
  name: 'Administrativo',
  path: '/admin',
  component: AdminPages,
  meta: { requiresAdmin: true }
}, {
  name: 'configuracao',
  path: '/configuracao',
  component: Configuracao,
  props: true
}, {
  name: 'formPaciente',
  path: '/formPaciente/:id',
  component: FormPaciente,
  props: true
}]

const router = new VueRouter({
  mode: 'history',
  routes
})

router.beforeEach((to, from, next) => {
  const json = localStorage.getItem(userKey)

  if (to.matched.some(record => record.meta.requiresAdmin)) {
    const usuario = JSON.parse(json)
    usuario && usuario.super === 1 ? next() : next({ path: '/' })
  } else {
    next()
  }
})

export default router
