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
        name: 'Atendimento',
        parentId: null,
        path: '/atendimento',
        hidden: false,
        children: [],
        icon: 'fa fa-ticket'
      }, {
        id: 3,
        name: 'Administrativo',
        parentId: null,
        path: '/admin',
        hidden: this.isAdmin,
        children: [],
        icon: 'fa fa-cogs'
      }, {
        id: 4,
        name: 'Gráficos',
        parentId: null,
        path: '/graficos',
        hidden: false,
        children: [],
        icon: 'fa fa-bar-chart'
      }, {
        id: 5,
        name: 'Sla',
        parentId: null,
        path: '/sla',
        hidden: true,
        children: [],
        icon: ''
      }, {
        id: 6,
        name: 'Versoes',
        parentId: null,
        path: '/versoes',
        hidden: this.isAdmin,
        children: [],
        icon: 'fa fa-code-fork'
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
    background: linear-gradient(to right, #232526, #414345);
    padding-left: 25px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}

.menu a,
.menu a:hover
{
  color: #fff;
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
