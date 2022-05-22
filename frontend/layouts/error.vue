<template>
	<div class="text-center">
		<div class="flex justify-center">
			<img src="/images/error-page.png" class="h-64" alt="">
		</div>
		<p class="mb-4 font-semibold text-lg">Opps, something went wrong!</p>
		<p class="text-primary text-2xl font-medium">{{ error.statusCode }}!</p>
		<p v-if="error.statusCode === 404">Page not found</p>
		<p v-else-if="error.statusCode === 500">Server Error</p>
		<p v-else-if="error.statusCode === 403">
			You are forbidden
		</p>
		<p v-else-if="error.statusCode === 401">
			You are unauthrized
		</p>
		<p v-else class="mb-4">
			{{ error.message }}
		</p>
		<!-- <NuxtLink class="bg-primary-500 px-8 py-3 mt-2 inline-block rounded-full text-sm uppercase" to="/">Back to home</NuxtLink> -->
	</div>
</template>

<script>
export default {
	name: "error",
	props: ["error"],
	layout: "errorLayout", // you can set a custom layout for the error page
};
</script>

<style lang="scss" scoped>
.nuxt-link-exact-active,
.nuxt-link-active {
	color: white !important;
}
</style>