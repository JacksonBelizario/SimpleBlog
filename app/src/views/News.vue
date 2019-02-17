<template>
	<v-flex xs12>
		<v-card v-for="post in posts" :key="post.id" :style="{marginBottom: '15px'}">
			<v-img
				:src="post.image"
				height="130px"
			>
			</v-img>

			<v-card-title primary-title>
				<v-layout align-start justify-start column fill-height >
					<div class="headline"><a class="black--text" @click="$router.push({ name: 'view', params: { id: post.id } })" >{{post.title}}</a>
					</div>
					<span><v-chip color="purple" text-color="white" v-for="tag in post.tags" :key="tag.id">{{tag.name}}</v-chip></span>
				</v-layout>
			</v-card-title>
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
