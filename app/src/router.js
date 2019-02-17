import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{
			path: "/",
			component: () => import("./containers/Blog.vue")
		},
		{
			path: "/login",
			component: () => import("./containers/Login.vue")
		},
		{
			path: "/dashboard",
			name: "Dashboard",
			component: () => import(/* webpackChunkName: "dashboard" */ "./containers/Dashboard.vue"),
			redirect: "/dashboard/noticias",
			meta: {
				requiresAuth: true
			},
			children: [
				{
					path: '/noticias',
					name: 'noticias',
					component: () => import(/* webpackChunkName: "news" */ "./views/News.vue"),
				},
			]
		},
	]
});

router.beforeEach((to, from, next) => {
  next();
});

export default router;
