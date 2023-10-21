<template>
  <div class="admin-pages">
      <PageTitle icon='fa fa-cogs' main="Administração do Sistema"
        sub="Cadastros & Cia" />
        <div class="admin-pages-tabs">
          <b-card no-body>
            <b-tabs card>
               <b-tab title="Usuarios" active>
                  <Usuarios />
                </b-tab>
                <b-tab title="Analistas">
                  <Analistas />
                </b-tab>
                <b-tab title="Atualizacoes">
                  <Atualizacoes />
                </b-tab>
                 <b-tab title="Consolidado">
                  <Consolidado />
                </b-tab>
                 <b-tab title="IpHabilitados">
                  <IpHabilitados />
                </b-tab>
                 <b-tab title="IpDesconhecidos">
                  <IpDesconhecidos />
                </b-tab>
                 <b-tab title="IpBloqueados">
                  <IpBloqueados />
                </b-tab>
            </b-tabs>
          </b-card>
        </div>
  </div>
</template>

<script>
import PageTitle from '@/components/template/PageTitle'
import Atualizacoes from './Atualizacoes'
import Consolidado from './Consolidado'
import IpHabilitados from './IpHabilitados'
import IpDesconhecidos from './IpDesconhecidos'
import IpBloqueados from './IpBloqueados'
import Usuarios from './Usuarios'
import Analistas from './Analistas'

export default {
  name: 'AdminPages',
  components: { PageTitle, Atualizacoes, Consolidado, IpHabilitados, IpDesconhecidos, IpBloqueados, Usuarios, Analistas }
}
</script>

<style>

</style>
