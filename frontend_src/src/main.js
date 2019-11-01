import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPlay } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import './formValidation/vee-validate';
import App from './App.vue';
import router from './router';
import store from './store';
import '@/assets/styles/main.scss';
import RepositoryFactory from './apiAccess/repositoryFactory';

const AuthRepository = RepositoryFactory.get('auth');

library.add(faPlay);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.config.productionTip = false;
Vue.use(BootstrapVue);

new Vue({
  router,
  store,
  render: h => h(App),
  created() {
    const token = localStorage.getItem('user-token');

    if (token) {
      AuthRepository.setAuthToken(token);
      this.$store.dispatch('loadSavedPrograms');
    }
  },
}).$mount('#app');
