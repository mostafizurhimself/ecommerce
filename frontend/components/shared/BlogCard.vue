<template>
	<div>
		<!-- blogs -->
		<div class="bg-white hover:border hover:border-gray-200 rounded-lg overflow-hidden mx-auto relative blog">
			<!-- image -->
			<div class="bg-white flex justify-center item-center product-image relative rounded-lg">
				<img :src="blog.image" class="h-full w-full" alt="product" style="object-fit: cover;">

				<!-- badge -->
				<div class="absolute bottom-3 left-3">
					<span class="blog-badge bg-primary-500 text-white text-xs px-5 py-1 rounded-full font-semibold">{{blog.category}}</span>
				</div>
			</div>

			<!-- details -->
			<div class="details p-4">
				<!-- author and date -->
				<div class="flex items-center mb-2">
					<!-- author -->
					<div class="flex items-center">
						<div class="w-4 h-4 rounded-full overflow-hidden border border-primary-500 cursor-pointer shadow-sm flex items-center justify-center">
							<img src="images/users/user-01.png" alt class="w-full h-full object-cover" />
						</div>
						<h6 class="text-gray-400 text-sm mb-0 ml-1 mt-1">{{blog.author}}</h6>
					</div>
					<!-- date -->
					<div class="flex items-center ml-3">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
						</svg>
						<h6 class="text-gray-400 text-sm mb-0 ml-1 mt-1">{{blog.data}}</h6>
					</div>
				</div>

				<nuxt-link to="#" class="text-md font-bold blog-title">{{blog.title}}</nuxt-link>

				<!-- price -->
				<p class="text-gray-400 text-xs my-2">{{blog.subtitle}}</p>

				<nuxt-link to="#" class="font-medium text-sm">
					<span class="inline-flex items-center">
						Read More
						<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
					</span>
				</nuxt-link>
			</div>

		</div>
		<!-- End blogs -->

	</div>
</template>

<script>
export default {
	name: "BlogCard",
	props: {
		blog: {
			type: Object,
		},
	},
};
</script>

<style lang="scss" scoped>
.blog {
	box-shadow: #7c3aed15 0px 3px 8px;
}
.blog:hover {
	box-shadow: #7c3aed1b 0px 4px 12px;

	.blog-title {
		@apply underline;
	}
}
</style>
