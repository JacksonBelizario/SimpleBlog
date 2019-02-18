<template>
	<v-app id="inspire">
		<v-content>
			<v-container fluid fill-height>
				<v-layout align-center justify-center>
					<v-flex xs12 sm8 md4>
						<v-card class="elevation-12">
							<v-toolbar dark color="primary">
								<v-toolbar-title>Autenticação</v-toolbar-title>
							</v-toolbar>
							<v-card-text>
								<v-form v-model="valid">
									<v-text-field v-model="form.email" prepend-icon="person" name="login" label="E-mail" type="text" :rules="emailRules" required></v-text-field>
									<v-text-field v-model="form.password" id="password" prepend-icon="lock" name="password" label="Senha" type="password" :rules="passRules" required></v-text-field>
								</v-form>
							</v-card-text>
							<v-card-actions>
								Login: admin@example.com | @dm1n
								<v-spacer></v-spacer>
								<v-btn color="primary" :disabled="!valid" @click="auth">Entrar</v-btn>
							</v-card-actions>
						</v-card>
					</v-flex>
				</v-layout>
			</v-container>
		</v-content>
	</v-app>
</template>

<script>
	export default {
		data: () => ({
			valid: false,
			form: {
				email: '',
				password: '',
			},
			emailRules: [
				v => !!v || 'Informe o e-mail',
				v => /.+@.+/.test(v) || 'Informe um e-mail válido'
			],
			passRules: [
				v => !!v || 'Informe a senha'
			],
		}),
		methods: {
			auth() {
				this.$http.post('/login', this.form).then(({data}) => {
					localStorage.setItem('token', data.token);
					this.$http.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
					this.$router.push({ name: 'dashboard' });
				}).catch(({data}) => {
					this.$root.error(data.message);
				})
			}
		}
	}
</script>
