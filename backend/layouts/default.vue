<template>
	<div>
		<the-header></the-header>
		<div style="padding-top: 80px">
			<Nuxt />
		</div>
		<the-footer></the-footer>
	</div>
</template>

<script>
export default {
	name: "default-layout",
	mounted() {
		this.$store.dispatch("cart/setCart");
	},

	async fetch() {
		try {
			await this.$store.dispatch("global/setGlobalValues", {
				url: "/config",
			});
		} catch (error) {
			console.error(error);
		}
	},
};
</script>

<style lang="scss">
h1,
h2,
h3,
h4,
h5,
h6 {
	font-family: "Josefin Sans", sans-serif !important;
}
</style>