<template>
	<v-flex xs12>
		<v-card v-for="post in posts" :key="post.id" :style="{marginBottom: '15px'}">
			<v-img
				:src="post.image"
				height="130px"
			>
			</v-img>

			<v-card-title primary-title>
				<div>
					<div class="headline"><a @click="$router.push({ name: 'view', params: { id: post.id } })" >{{post.title}}</a>
					</div>
					<span class="grey--text">Tags</span>
				</div>
			</v-card-title>

			<v-card-actions>
				<v-btn flat color="purple">Compartilhar</v-btn>
				<v-spacer></v-spacer>
				<v-btn icon @click="post.show = !post.show">
					<v-icon>{{ !post.show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
				</v-btn>
			</v-card-actions>

			<v-slide-y-transition>
				<v-card-text v-show="post.show">
					{{post.body}}
				</v-card-text>
			</v-slide-y-transition>
		</v-card>
	</v-flex>
</template>
<script>
	export default {
		data: () => ({
			posts: []
		}),
		methods: {
			getPosts() {
				this.$http.get("posts").then(({data}) => {
					this.posts = data.data.map(post => {
						post.show = false;
						return post;
					});
				})
			}
		},
		created() {
			this.getPosts()
		},
	}
</script>
