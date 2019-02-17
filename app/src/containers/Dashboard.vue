<template>
	<v-app id="inspire">
		<v-navigation-drawer
			:clipped="$vuetify.breakpoint.lgAndUp"
			app
			fixed
			v-model="drawer"
		>
			<v-list dense>
				<template v-for="item in items">
					<v-layout
						:key="item.heading"
						align-center
						row
						v-if="item.heading"
					>
						<v-flex xs6>
							<v-subheader v-if="item.heading">
								{{ item.heading }}
							</v-subheader>
						</v-flex>
					</v-layout>
					<v-list-group
						:key="item.text"
						:prepend-icon="item.model ? item.icon : item['icon-alt']"
						append-icon=""
						v-else-if="item.children"
						v-model="item.model"
					>
						<v-list-tile slot="activator">
							<v-list-tile-content>
								<v-list-tile-title>
									{{ item.text }}
								</v-list-tile-title>
							</v-list-tile-content>
						</v-list-tile>
						<v-list-tile
							:key="i"
							@click=""
							v-for="(child, i) in item.children"
						>
							<v-list-tile-action v-if="child.icon">
								<v-icon>{{ child.icon }}</v-icon>
							</v-list-tile-action>
							<v-list-tile-content>
								<v-list-tile-title>
									{{ child.text }}
								</v-list-tile-title>
							</v-list-tile-content>
						</v-list-tile>
					</v-list-group>
					<v-list-tile :key="item.text"
								 @click="$router.push({ name: item.to })" v-else>
						<v-list-tile-action>
							<v-icon>{{ item.icon }}</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<v-list-tile-title>
								{{ item.text }}
							</v-list-tile-title>
						</v-list-tile-content>
					</v-list-tile>
				</template>
			</v-list>
		</v-navigation-drawer>
		<v-toolbar
			:clipped-left="$vuetify.breakpoint.lgAndUp"
			app
			color="blue darken-3"
			dark
			fixed
		>
			<v-toolbar-title class="ml-0 pl-3" style="width: 300px">
				<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
				<span class="hidden-sm-and-down">Dashboard</span>
			</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn icon>
				<v-icon>apps</v-icon>
			</v-btn>
		</v-toolbar>
		<v-content>
			<v-container fill-height fluid>
				<v-layout align-center justify-center>
					<router-view :key="$route.fullPath"></router-view>
				</v-layout>
			</v-container>
		</v-content>
	</v-app>
</template>

<script>
	export default {
		data: vm => ({
			drawer: null,
			items: [
				{
					icon: 'home',
					text: 'Início',
					to: 'news'
				},
				{
					icon: 'view_list',
					text: 'Posts',
					to: 'dash-posts'
				},
				{
					icon: 'people',
					text: 'Autores',
					to: 'dash-authors'
				},
			],
		}),
		props: {
			source: String
		}
	};
</script>
