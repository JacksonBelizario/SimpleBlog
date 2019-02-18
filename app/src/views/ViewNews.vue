<template>
	<v-flex xs12>
		<v-card>
			<v-img
				:src="post.image"
				height="150px"
			>
			</v-img>

			<v-card-title primary-title>
				<v-layout align-start justify-start column fill-height >
					<div class="headline">{{post.title}}</div>
					<span><v-chip color="purple" text-color="white" v-for="tag in post.tags" :key="tag.id">{{tag.name}}</v-chip></span>
				</v-layout>
			</v-card-title>

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
					this.post = data.data;
				})
			}
		},
		created() {
			this.showPost()
		},
	}
</script>
