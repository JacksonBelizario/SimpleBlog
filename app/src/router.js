import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
	routes: [
		{
			path: "/",
			component: () => import("./containers/Home.vue"),
			redirect: "/news",
			children: [
				{
					path: '/news',
					name: 'news',
					component: () => import("./views/News.vue"),
				},
				{
					path: '/view/:id',
					name: 'view',
					props: true,
					component: () => import("./views/ViewNews.vue"),
				},
			]
		},
		{
			path: "/login",
			component: () => import("./containers/Login.vue")
		},
		{
			path: "/dashboard",
			name: "dashboard",
			component: () => import(/* webpackChunkName: "dashboard" */ "./containers/Dashboard.vue"),
			redirect: "/dashboard/posts",
			meta: {
				requiresAuth: true
			},
			children: [
				{
					path: '/dashboard/posts',
					name: 'dash-posts',
					component: () => import("./views/DashNews.vue"),
				},
				{
					path: '/dashboard/authors',
					name: 'dash-authors',
					component: () => import("./views/About.vue"),
				},
			]
		},
	]
});

router.beforeEach((to, from, next) => {
  next();
});

export default router;
