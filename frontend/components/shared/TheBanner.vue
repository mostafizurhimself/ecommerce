<template>
	<div>
		<div class="banner flex items-center justify-center sm:h-52 md:h-72 lg:h-96" :style="{ backgroundImage: bannerImage }">
			<div class="banner__text text-center">
				<p class="font-bold text-white text-2xl md:text-4xl mt-5 sm:mt-0 inline-block">
					<slot name="header">Page Name</slot>
				</p>

				<div class="py-3 px-5 mb-4 text-white">
					<ul class="flex justify-center">
						<slot name="breadcrumbs">
							<li>
								<nuxt-link to="/" class="font-semibold">Home</nuxt-link>
							</li>
							<li><span class="mx-2">-</span></li>
							<li>
								<nuxt-link to="#" class="font-semibold text-primary-500">Page Name</nuxt-link>
							</li>
						</slot>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "banner",
	props: {
		bannerLink: {
			type: String,
			default: "/images/banners/banner-01.jpg",
		},
	},

	computed: {
		bannerImage() {
			if (this.bannerLink) {
				return `linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),
          url(${this.bannerLink})`;
			}
		},
	},
};
</script>

<style lang="scss" scoped>
.banner {
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
</style>
