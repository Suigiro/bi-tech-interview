import Vue from 'vue'
import App from './App.vue'
import store from '@/store/store'
import router from '@/router/router'
import 'font-awesome/css/font-awesome.css'
import '@/plugins/bootstrap'
import '@/plugins/apexcharts'
import '@/config/msgs'
import '@/config/axios'
import '@/config/mq'
import '@/plugins/vue-select'
import VueMask from 'v-mask'

Vue.config.productionTip = false
Vue.use(VueMask)

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
