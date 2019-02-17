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
						<v-layout row >
							<v-flex xs12>
								<v-card v-for="post in posts" :key="post.id" :style="{marginBottom: '15px'}">
									<v-img
										:src="post.image"
										height="130px"
									>
									</v-img>

									<v-card-title primary-title>
										<div>
											<div class="headline">{{post.title}}</div>
											<span class="grey--text">1,000 miles of wonder</span>
										</div>
									</v-card-title>

									<v-card-actions>
										<v-btn flat>Share</v-btn>
										<v-btn flat color="purple">Explore</v-btn>
										<v-spacer></v-spacer>
										<v-btn icon @click="post.show = !post.show">
											<v-icon>{{ post.show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
										</v-btn>
									</v-card-actions>

									<v-slide-y-transition>
										<v-card-text v-show="post.show">
											{{post.body}}
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
			posts: []
		}),
		props: {
			source: String
		},
		methods: {
			getPosts() {
				this.$http.get("posts").then(({data}) => {
					console.log('posts', data);
					this.posts = data.map(post => {
						post.show = false;
						return post;
					});
				})
			}
		},
		created() {
			this.getPosts()
		}
	}
</script>
