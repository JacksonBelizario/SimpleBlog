<template>
	<v-flex xs12>
		<v-card>
			<v-img
				:src="post.image"
				height="150px"
			>
			</v-img>

			<v-card-title primary-title>
				<div>
					<div class="headline">{{post.title}}</div>
					<span class="grey--text text-left">Tags</span>
				</div>
			</v-card-title>

			<v-card-actions>
				<v-btn flat color="purple">Compartilhar</v-btn>
			</v-card-actions>
			<v-card-text>
				{{post.body}}
			</v-card-text>
		</v-card>
	</v-flex>
</template>
<script>
	export default {
		props: ["id"],
		data: () => ({
			post: {}
		}),
		methods: {
			showPost() {
				this.$http.get(`posts/${this.id}`).then(({data}) => {
					this.post = data;
				})
			}
		},
		created() {
			this.showPost()
		},
	}
</script>
