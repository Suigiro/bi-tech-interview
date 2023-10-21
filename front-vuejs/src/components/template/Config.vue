<template>
    <div class="config-dropdown">
      <div class="config-button">
        <span class="d-none d-sm-block">{{ usuario.nome }}</span>
        <div class="config-dropdown-img">
            <img class="profileImg" src="@/assets/image/img_avatar4.png" alt="Usuário">
        </div>
        <i class="fa fa-angle-down"></i>
      </div>
      <div class="config-dropdown-content">
         <router-link to='/configuracao'><i class="fa fa-cogs"></i>Configurações</router-link>
        <a href @click.prevent="logout"><i class="fa fa-sign-out"></i>Sair</a>
      </div>
    </div>
</template>

<script>
import { userKey } from '@/config/global'
import { mapState } from 'vuex'
export default {
  name: 'Config',
  computed: mapState(['isMenuVisible', 'isConfigVisible', 'usuario']),
  methods: {
    logout () {
      localStorage.removeItem(userKey)
      this.$store.commit('setUsuario', null)
      this.$store.commit('setIsMenuVisible', false)
      this.$store.commit('setIsConfigVisible', false)
      this.$router.push({ name: 'auth' })
    }
  }

}
</script>

<style>

.config-dropdown{
  position: relative;
  height: 100%;
}

.config-button{
  display: flex;
  align-items: center;
  color:#fff;
  font-weight: 100;
  height: 100%;
  padding: 0px 20px;
}

.config-button:hover{
  background-color: rgba(0,0,0,0.2);
}

.config-dropdown-img {
  margin: 0px 10px;
}

.config-dropdown-img > img {
   max-width: 3.5rem;
   max-height: 3.5rem;
   border-radius:0.5rem;
}

.config-dropdown-content {
  position: absolute;
  right: 0px;
  background-color: #f9f9f9;
  min-width: 170px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 10px;
  z-index: 1;

  display:flex;
  flex-direction: column;
  flex-wrap: warp;

  visibility: hidden;
  opacity: 0;
  transition: visibility 0s, opacity 0.5s linear;
  }

  .config-dropdown:hover .config-dropdown-content {
    visibility: visible;
    opacity: 1;
  }
  .config-dropdown-content a {
     text-decoration: none;
     color:#000;
     padding: 10px;
   }
   .config-dropdown-content a:hover {
     text-decoration: none;
     color:#000;
     background-color:#EDEDED;
   }
</style>
