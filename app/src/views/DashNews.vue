<template>
	<v-layout row>
		<v-flex xs12>
			<v-card>

				<v-list three-line>
					<v-toolbar flat color="white">
						<v-toolbar-title>Notícias</v-toolbar-title>
						<v-divider
							class="mx-2"
							inset
							vertical
						></v-divider>
						<v-spacer></v-spacer>
						<v-dialog v-model="dialog" max-width="500px">
							<v-btn slot="activator" color="primary" dark class="mb-2">Nova Postagem</v-btn>
							<v-card>
								<v-card-title>
									<span class="headline">{{ formTitle }}</span>
								</v-card-title>

								<v-card-text>
									<v-container grid-list-md>
										<v-layout row wrap>
											<v-flex xs12 align-center justify-space-between>
												<v-layout align-center>
													<v-text-field
														v-model="editedItem.title"
														label="Titulo"
													></v-text-field>
												</v-layout>
											</v-flex>
											<v-flex xs12>
												<v-text-field
													v-model="editedItem.image"
													label="Imagem"
												></v-text-field>
											</v-flex>
											<v-flex xs12>
												<v-textarea
													v-model="editedItem.body"
													label="Descrição"
												></v-textarea>
											</v-flex>
											<v-flex xs12>
												<v-select
													v-model="editedItem.tags"
													:items="tags"
													item-text="name"
													item-value="id"
													attach
													chips
													label="Tags"
													multiple
												></v-select>
											</v-flex>
										</v-layout>
									</v-container>
								</v-card-text>

								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn color="blue darken-1" flat @click="close">Cancelar</v-btn>
									<v-btn color="blue darken-1" flat @click="save">Salvar</v-btn>
								</v-card-actions>
							</v-card>
						</v-dialog>
					</v-toolbar>
					<v-data-table
						:headers="headers"
						:items="posts"
						class="elevation-1"
						hide-actions
						:pagination.sync="pagination"
					>
						<template slot="items" slot-scope="props">
							<td>{{ props.item.id }}</td>
							<td>{{ props.item.title }}</td>
							<td>{{ props.item.author.name }}</td>
							<td class="justify-center layout px-0">
								<v-icon
									small
									class="mr-2"
									@click="editItem(props.item)"
								>
									edit
								</v-icon>
								<v-icon
									small
									@click="deleteItem(props.item)"
								>
									delete
								</v-icon>
							</td>
						</template>
					</v-data-table>
					<div class="text-xs-center pt-2">
						<v-pagination v-model="pagination.page" @input="paginate" :length="pages"></v-pagination>
					</div>
				</v-list>
			</v-card>
		</v-flex>
	</v-layout>
</template>

<script>
	export default {
		data() {
			return {
				headers: [
					{ text: '#', value: 'id' },
					{ text: 'Titulo', value: 'title' },
					{ text: 'Autor', value: 'author.name' },
					{ text: '', value: 'name', sortable: false },
				],
				posts: [],
				tags: [],
				pages: 1,
				pagination: {
					page: 1,
					per_page: 15,
					sortBy: 'id',
					descending: true,
					tags: [],
				},
				dialog: false,
				editedIndex: -1,
				editedItem: {
					title: "",
					body: "",
					image: "",
					author_id: 1,
					published: true,
					tags: [],
				},
				defaultItem: {
					title: "",
					body: "",
					image: "",
					author_id: 1,
					published: true,
				}
			};
		},
		computed: {
			formTitle () {
				return this.editedIndex === -1 ? 'Nova Postagem' : 'Editar Postagem'
			}
		},
		methods: {
			getTags() {
				this.$http.get("tags")
					.then(({data}) => {
						console.log('tags', data);
						this.tags = data;
					})
			},

			getPosts(page) {
				this.$http.get("posts", {params: { page }})
					.then(({data}) => {
						if (page === 1) {
							this.pagination.page = page;
							this.pages = data.meta.last_page;
							this.pagination.rowsPerPage = data.meta.per_page;
							this.pagination.totalItems = data.meta.total;
						}
						this.posts = data.data.map(post => {
							post.show = false;
							return post;
						});
					})
			},

			editItem (item) {
				this.editedIndex = this.posts.indexOf(item);
				this.editedItem = Object.assign({}, item);
				this.dialog = true
			},

			deleteItem (item) {
				const index = this.posts.indexOf(item);
				confirm('Tem certeza que deseja remover este post?') && this.delete(index)
			},

			async delete(index) {
				try {
					const id = this.posts[index].id;
					await this.$http.delete(`posts/${id}`);
					this.posts.splice(index, 1)
				} catch (err) {
					console.warn(err);
				}
			},

			close () {
				this.dialog = false;
				setTimeout(() => {
					this.editedItem = Object.assign({}, this.defaultItem);
					this.editedIndex = -1;
				}, 300)
			},

			async save () {
				try {
					if (this.editedIndex > -1) {
						const id = this.posts[this.editedIndex].id;
						const {data} = await this.$http.put(`posts/${id}`, this.editedItem);
						Object.assign(this.posts[this.editedIndex], data)
					} else {
						const {data} = await this.$http.post("posts", this.editedItem);
						this.posts.push(data);
					}
				} catch (err) {
					console.warn(err);
				}
				this.close()
			},
			paginate() {
				this.getPosts(this.pagination.page);
			}
		},
		created() {
			this.paginate();
			this.getTags();
		},

		watch: {
			dialog (val) {
				val || this.close()
			}
		},
	};
</script>
