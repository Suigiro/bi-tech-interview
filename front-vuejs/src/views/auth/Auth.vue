<template>
    <div class="auth-content">
        <div class="auth-modal">
            <img src="@/assets/image/union_fullsize_distr.png" alt="Logo" class="logo" />
            <hr />
            <div class="auth-title">Login</div>
            <input v-model="auth.email" name="email" type="email" placeholder="E-mail" />
            <input v-model="auth.password" name="password" type="password" placeholder="Password" />
            <button @click="signin">Login</button>
        </div>
    </div>
</template>

<script>
import { baseApiUrl, showError, userKey, showSuccess } from '@/config/global'
import axios from 'axios'
import { mapState } from 'vuex'

export default {
  name: 'Auth',
  computed: mapState(['isMenuVisible']),
  data: function () {
    return {
      auth: {}
    }
  },
  methods: {
    async signin () {
      this.$store.commit('setLoading', true)
      await axios.post(`${baseApiUrl}/login`, this.auth)
        .then(res => {
          this.$store.commit('setUsuario', res.data)
          localStorage.setItem(userKey, JSON.stringify(res.data))
          this.$store.commit('setLoading', false)
          this.$router.push({ name: 'home' })
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
    },
    clear () {
      localStorage.removeItem(userKey)
      this.$store.commit('setUsuario', null)
      this.$store.commit('setIsMenuVisible', false)
      this.$store.commit('setIsConfigVisible', false)
    }
  },
  mounted () {
    this.clear()
  },
  created () {
    this.clear()
  }
}
</script>

<style>
    .auth-content {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth-modal {
        background-color: #fff;
        width: 350px;
        padding: 35px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.15);

        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .logo {
        width: 15rem;
    }
    .auth-modal input {
        border: 1px solid #bbb;
        width: 100%;
        margin-bottom: 15px;
        padding: 3px 8px;
        outline: none;
    }
    .auth-modal button {
        align-self: center;
        background-color:  #2460ae;
        color: #fff;
        padding: 5px 15px;
        border-radius: 5px;
    }
    .auth-modal hr {
        border: 0;
        width: 100%;
        height: 1px;
        background-image: linear-gradient(to right,
            rgba(120,120,120,0),
            rgba(120,120,120,0.75),
            rgba(120,120,120,0));
    }
</style>
