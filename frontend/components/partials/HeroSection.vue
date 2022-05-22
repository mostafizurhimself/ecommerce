<template>
	<div class="hero bg-primary-50 py-10 lg:py-20">
		<div class="container flex flex-col lg:flex-row">
			<!-- left side -->
			<div class="lg:w-1/2 flex flex-col items-center lg:items-start lg:justify-center">
				<div class="flex items-center">
					<div class="h-3 w-3 bg-primary-500"></div>
					<p class="text-sm ml-2 font-medium">100% organic products</p>
				</div>
				<h3 class="font-bold text-4xl md:text-5xl lg:text-6xl mt-4">Tasty & Healthy</h3>
				<p class="text-xs md:text-sm lg:text-lg mt-4 font-medium">Lorem ipsum dolor sit amet consectetur Id, nihil.</p>

				<!-- purchase button -->
				<nuxt-link to="/shop" class="bg-primary-500 hover:bg-primary-600 rounded-full inline-flex p-1 items-center justify-center mt-5">
					<div class="bg-white rounded-full h-7 md:h-10 w-7 md:w-10 flex items-center justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
						</svg>
					</div>
					<span class="text-xs uppercase font-medium text-white tracking-widest ml-4 pr-6">Purchase Now</span>
				</nuxt-link>
			</div>

			<!-- right side -->
			<div class="lg:w-1/2 flex justify-center items-center mt-14 lg:mt-0">
				<!-- image -->
				<img src="images/banners/hero.png" class="h-64 md:h-80 lg:h-96" alt="">
			</div>
		</div>
	</div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>