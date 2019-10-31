<template>
  <b-navbar toggleable="lg" type="dark" variant="primary">
    <b-navbar-brand to="/">Project name</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item to="/">Home</b-nav-item>
        <b-nav-item to="/workspace">Workspace</b-nav-item>
        <b-nav-item to="/faq">About</b-nav-item>
      </b-navbar-nav>

      <b-navbar-nav class="ml-auto">
        <b-nav-item v-for="item in menuItems"
                    v-bind:key="item.title">
          {{ item.title }}
        </b-nav-item>

        <b-nav-item v-if="userIsAuthenticated"
                    @click="onLogout">
          Logout
        </b-nav-item>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: 'nav-header',
  data() {
    return {

    };
  },
  computed: {
    menuItems() {
      let menuItems = [
        { title: 'Register', link: '/register' },
        { title: 'Login', link: '/login' },
      ];

      if (this.userIsAuthenticated) {
        menuItems = [];
      }

      return menuItems;
    },

    userIsAuthenticated() {
      return !!this.$store.getters.user.token;
    },
  },
  methods: {
    onLogout() {
      const user = {
        token: null,
      };

      localStorage.removeItem('user-token');
      this.$store.commit('setSelectedProgram', null);
      this.$store.commit('setSavedPrograms', []);
      this.$store.commit('setUser', user);
      this.$store.commit('setCodeResultOutput', '');
      this.$store.commit('setPythonCodeErrors', '');

      this.$router.push({ name: 'home' });
    },
  },
};
</script>
