<template>
	<v-dialog
		v-model="dialog"
		hide-overlay
		persistent
		width="300"
		:style="{ zIndex: options.zIndex }"
	>
		<v-card
			:color="options.color"
			dark
		>
			<v-card-text v-html="message">
			</v-card-text>
		</v-card>
	</v-dialog>
</template>

<script>
	export default {
		data: () => ({
			dialog: false,
			message: null,
			options: {
				color: 'primary',
				zIndex: 200
			}
		}),
		methods: {
			success(message, timeout = 2000) {
				this.open(message, timeout, "success")
			},
			warning(message, timeout = 2000) {
				this.open(message, timeout, "warning")
			},
			error(message, timeout = 2000) {
				this.open(message, timeout, "red")
			},
			info(message, timeout = 2000) {
				this.open(message, timeout, "info")
			},
			open(message, timeout = 2000, color = "primary") {
				this.options.color = color;
				this.dialog = true;
				this.message = message;
				setTimeout(() => {
					this.dialog = false;
				}, timeout);
			},
		}
	}
</script>
