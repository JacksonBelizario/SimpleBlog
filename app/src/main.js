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
		const token = localStorage.getItem('token');
		if (token) {
			this.$http.defaults.headers.common['Authorization'] = `Bearer ${token}`;
		}
		this.$http.interceptors.response.use(
			config => config,
			error => {
				if (error.response) {
					if (error.response.status === 401) {
						this.$router.push({ name: 'login' });
						return Promise.reject('Erro de autenticação');
					}
					return Promise.reject(error.response);
				}
				return Promise.reject(error);
			});
	},
	render: h => h(App)
}).$mount('#app');
