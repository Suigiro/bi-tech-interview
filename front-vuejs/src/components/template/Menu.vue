<template>
  <aside class="menu" v-show="isMenuVisible">
    <b-navbar-nav>
      <b-nav-item class='link' v-for="link in treeData" :key="link.id" :to="link.path" @click='onCheck' v-show="!link.hidden"><i v-if="link.icon!==''" :class="link.icon"></i>&nbsp;&nbsp;&nbsp;{{ link.name }}</b-nav-item>
    </b-navbar-nav>
  </aside>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'Menu',
  computed: mapState(['isMenuVisible', 'isToggle', 'isConfigVisible', 'isAdmin']),
  data () {
    return {
      treeData: this.getTreeData(),
      treeOptions: {
        propertyNames: {
          text: 'name'

        }
      }
    }
  },
  methods: {
    getTreeData () {
      return [{
        id: 1,
        name: 'Home',
        parentId: null,
        path: '/home',
        hidden: false,
        children: [],
        icon: 'fa fa-home'
      }, {
        id: 2,
        name: 'Pacientes',
        parentId: null,
        path: '/pacientes',
        hidden: false,
        children: [],
        icon: 'fa fa-users'
      }]
    },
    onCheck () {
      if (this.$mq === 'xs' || this.$mq === 'sm') {
        this.$store.commit('toggleMenu', false)
      }
    }
  }
}
</script>

<style>
.menu {
    grid-area: menu;
    background: linear-gradient(to right, #0c1d59, #305bf2);
    padding-left: 25px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}

.menu a,
.menu a:hover,
.menu a:active
{
  color: #fff !important;
  text-decoration: none;
}

.menu li > a:hover
 {
   background-color: rgba(255,255,255,0.2);
}

.link{
  text-indent:10px;
}

</style>
