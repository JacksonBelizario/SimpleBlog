<template>
	<v-app>
		<router-view></router-view>
		<alert ref="alert"></alert>
		<confirm ref="confirm"></confirm>
	</v-app>
</template>

<script>
	export default {
		name: "app",
		components: {
			alert: () => import("./components/Alert.vue"),
			confirm: () => import("./components/Confirm.vue")
		},
		methods: {
			success(...params) {
				this.$refs.alert.success(...params)
			},
			warning(...params) {
				this.$refs.alert.warning(...params)
			},
			error(...params) {
				this.$refs.alert.error(...params)
			},
			info(...params) {
				this.$refs.alert.info(...params)
			},
			confirm(...params) {
				this.$refs.confirm.open(...params)
			}
		},
		mounted() {
			this.$root.confirm = this.confirm;
			this.$root.success = this.success;
			this.$root.warning = this.warning;
			this.$root.error = this.error;
			this.$root.info = this.info;
		}
	};
</script>
