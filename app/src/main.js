import Vue from 'vue';
import './plugins/vuetify';
import App from './App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);

Vue.config.productionTip = false;

new Vue({
	router,
	store,
	created() {
		this.$http.defaults.baseURL = process.env.VUE_APP_API_URL;
		// this.$http.defaults.headers.common['Authorization'] = AUTH_TOKEN;
	},
	render: h => h(App)
}).$mount('#app');
