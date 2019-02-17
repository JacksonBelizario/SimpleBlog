<template>
	<v-app id="inspire">
		<v-navigation-drawer
			v-model="drawer"
			fixed
			right
			app
		>
			<v-list dense>
				<v-list-tile @click="$router.push({ name: 'news' })">
					<v-list-tile-action>
						<v-icon>home</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						<v-list-tile-title>Notícias</v-list-tile-title>
					</v-list-tile-content>
				</v-list-tile>
				<v-list-tile @click="$router.push({ name: 'dashboard' })">
					<v-list-tile-action>
						<v-icon>https</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						<v-list-tile-title>Painel Administrativo</v-list-tile-title>
					</v-list-tile-content>
				</v-list-tile>
			</v-list>
		</v-navigation-drawer>
		<v-toolbar color="cyan" dark fixed app>
			<v-spacer></v-spacer>
			<v-toolbar-title>Blog</v-toolbar-title>
			<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
		</v-toolbar>
		<v-content>
			<v-container fluid>
				<v-layout justify-center align-center>
					<v-flex text-xs-center>
						<v-layout row >
							<router-view :key="$route.fullPath"></router-view>
						</v-layout>
					</v-flex>
				</v-layout>
			</v-container>
		</v-content>
		<v-footer color="cyan" app>
			<v-spacer></v-spacer>
			<span class="white--text">&copy; 2019</span>
		</v-footer>
	</v-app>
</template>

<script>
	export default {
		data: () => ({
			drawer: null,
		}),
	}
</script>
