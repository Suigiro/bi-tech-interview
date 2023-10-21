<template>
    <div class="configuracoes">
      <PageTitle icon='fa fa-cogs' main="Administração do Sistema"
        sub="Configurações" />
         <div class="configuracoes-tabs">
          <b-card no-body>
            <b-tabs card>
                <b-tab title="Usuarios" active>
                  <Usuarios />
                </b-tab>
            </b-tabs>
          </b-card>
        </div>
  </div>
</template>

<script>
// import { baseApiUrl, showError } from '@/config/global'
// import axios from 'axios'
import PageTitle from '@/components/template/PageTitle'
import Usuarios from './configuracao/Usuarios'

export default {
  components: { PageTitle, Usuarios }
}
</script>

<style>

</style>
