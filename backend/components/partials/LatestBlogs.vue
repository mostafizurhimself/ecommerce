<template>
	<div class="bg-white py-10">
		<div class="container">
			<!-- section header -->
			<section-header>
				<template #title>
					Latest Blogs
				</template>
				<template #subtitle>
					Completely network impactful users whereas next-generation
					applications.
				</template>
			</section-header>

			<!-- blogs -->
			<div class="grid md:grid-cols-3 gap-7 mt-10">
				<div class="" v-for="(item, i) in 3" :key="i">
					<blog-card></blog-card>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>