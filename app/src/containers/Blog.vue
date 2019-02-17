<template>
	<v-app id="inspire">
		<v-navigation-drawer
			v-model="drawer"
			fixed
			right
			app
		>
			<v-list dense>
				<v-list-tile @click="">
					<v-list-tile-action>
						<v-icon>home</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						<v-list-tile-title>Home</v-list-tile-title>
					</v-list-tile-content>
				</v-list-tile>
				<v-list-tile @click="$router.push('dashboard')">
					<v-list-tile-action>
						<v-icon>contact_mail</v-icon>
					</v-list-tile-action>
					<v-list-tile-content>
						<v-list-tile-title>Painel Administrativo</v-list-tile-title>
					</v-list-tile-content>
				</v-list-tile>
			</v-list>
		</v-navigation-drawer>
		<v-toolbar color="cyan" dark fixed app>
			<v-spacer></v-spacer>
			<v-toolbar-title>Application</v-toolbar-title>
			<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
		</v-toolbar>
		<v-content>
			<v-container fluid fill-height>
				<v-layout justify-center align-center>
					<v-flex text-xs-center>
						<v-layout row>
							<v-flex xs12>
								<v-card>
									<v-img
										src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
										height="130px"
									>
									</v-img>

									<v-card-title primary-title>
										<div>
											<div class="headline">Top western road trips</div>
											<span class="grey--text">1,000 miles of wonder</span>
										</div>
									</v-card-title>

									<v-card-actions>
										<v-btn flat>Share</v-btn>
										<v-btn flat color="purple">Explore</v-btn>
										<v-spacer></v-spacer>
										<v-btn icon @click="show = !show">
											<v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
										</v-btn>
									</v-card-actions>

									<v-slide-y-transition>
										<v-card-text v-show="show">
											I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.
										</v-card-text>
									</v-slide-y-transition>
								</v-card>
							</v-flex>
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
			show: false,
			posts: []
		}),
		props: {
			source: String
		},
		methods: {
			getPosts() {
				this.$http.get("posts").then(({data}) => {
					console.log('posts', data);
					this.posts = data;
				})
			}
		},
		created() {
			this.getPosts()
		}
	}
</script>
