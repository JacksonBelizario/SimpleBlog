<template>
	<v-layout row>
		<v-flex xs12>
			<v-card>

				<v-list three-line>
					<template v-for="(item, index) in news">
						<v-subheader
							:key="item.header"
							v-if="item.header"
						>
							{{ item.header }}
						</v-subheader>

						<v-divider
							:inset="item.inset"
							:key="index"
							v-else-if="item.divider"
						></v-divider>

						<v-list-tile
							:key="item.title"
							@click=""
							avatar
							v-else
						>
							<v-list-tile-avatar>
								<img :src="item.image">
							</v-list-tile-avatar>

							<v-list-tile-content>
								<v-list-tile-title>{{item.title}}</v-list-tile-title>
								<v-list-tile-sub-title>{{item.date}} ({{item.timeago}})</v-list-tile-sub-title>
							</v-list-tile-content>
						</v-list-tile>
					</template>
				</v-list>
			</v-card>
		</v-flex>
	</v-layout>
</template>

<script>
	const BASE_URL = null;
	export default {
		data() {
			return {
				news: []
			};
		},
		methods: {
			async getNews() {
				const { data } = await this.axios.get(
					`${BASE_URL}json/_app.php`
				);

				this.news = data.results;
			}
		},
		created() {
			this.getNews();
		}
	};
</script>
