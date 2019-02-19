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
											<v-flex xs8>
												<v-select
													:items="authors"
													item-text="name"
													item-value="id"
													v-model="editedItem.author"
													@input="(value) => { editedItem.author_id = value.id }"
													label="Autor"
													return-object
												></v-select>
											</v-flex>
											<v-flex xs4>
												<v-switch v-model="editedItem.published" label="Publicado"></v-switch>
											</v-flex>
											<v-flex xs12>
												<v-text-field
													v-model="editedItem.title"
													label="Titulo"
												></v-text-field>
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
									<v-btn color="red darken-1" flat @click="close">Cancelar</v-btn>
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
						<v-pagination v-model="pagination.page" :length="pages"></v-pagination>
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
				authors: [],
				pagination: {
					page: 1,
					per_page: 15,
					sortBy: 'id',
					descending: true,
				},
				dialog: false,
				editedIndex: -1,
				editedItem: {
					title: "",
					body: "",
					image: "",
					author: {},
					author_id: 1,
					published: true,
					tags: [],
				},
				defaultItem: {
					title: "",
					body: "",
					image: "",
					author: {},
					author_id: 1,
					published: true,
				}
			};
		},
		computed: {
			formTitle () {
				return this.editedIndex === -1 ? 'Nova Postagem' : `Editar Postagem: ${this.posts[this.editedIndex].id}`
			},
			pages () {
				if (this.pagination.rowsPerPage == null ||
					this.pagination.totalItems == null
				) return 0;

				return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
			}
		},
		methods: {
			getAuthors() {
				this.$http.get("authors")
					.then(({data}) => {
						this.authors = data;
						this.defaultItem.author = data[0];
					})
			},

			getTags() {
				this.$http.get("tags")
					.then(({data}) => {
						this.tags = data;
					})
			},

			getPosts() {
				this.$http.get("posts/all")
					.then(({data}) => {
						this.pagination.totalItems = data.data.length;
						this.posts = data.data.map(post => {
							post.show = false;
							return post;
						});
					})
			},

			editItem (item) {
				this.editedIndex = this.posts.indexOf(item);
				// this.editedItem = Object.assign({}, item);
				this.editedItem.title = item.title;
				this.editedItem.body = item.body;
				this.editedItem.image = item.image;
				this.editedItem.author = item.author;
				this.editedItem.author_id = item.author_id;
				this.editedItem.published = item.published;
				this.editedItem.tags = item.tags;
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
					this.posts.splice(index, 1);
					this.$root.success("Deletado com sucesso");
					this.pagination.totalItems--;
				} catch ({data}) {
					this.$root.error(data.message);
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
				let item = this.editedItem;
				try {
					if (this.editedIndex > -1) {
						const id = this.posts[this.editedIndex].id;
						await this.$http.put(`posts/${id}`, item);
						item.id = id;
						this.posts.splice(this.editedIndex, 1, item);
						this.$root.success("Postagem Salva");
					} else {
						const {data} = await this.$http.post("posts", item);
						item.id = data.id;
						this.posts.push(item);
						this.$root.success("Postagem Salva");
						this.pagination.totalItems++;
					}
				} catch ({data}) {
					this.$root.error(data.message);
				}
				this.close()
			}
		},
		created() {
			this.getPosts();
			this.getTags();
			this.getAuthors();
		},

		watch: {
			dialog (val) {
				val || this.close()
			}
		},
	};
</script>
