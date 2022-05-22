<template>
	<div class="w-full mx-auto">
		<client-only>
			<vue-slick-carousel v-bind="categoriesSettings">
				<div v-for="(category, i) in categories" :key="i">
					<div class="food-item">
						<div class="food-thumbnail">
							<img :src="category.primaryMediaUrl" class="w-full h-full object-cover" alt="" />
						</div>
						<div class="food-content pt-2">
							<p href="#">{{ category.name }}</p>
						</div>
					</div>
				</div>

				<template #prevArrow>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
					</svg>
				</template>

				<template #nextArrow>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
					</svg>
				</template>
			</vue-slick-carousel>
		</client-only>
	</div>
</template>

<script>
export default {
	name: "category-slider",
	props: {
		categories: {
			type: Array,
		},
	},

	data() {
		return {
			categoriesSettings: {
				slidesToShow: 4,
				slidesToScroll: 4,
				centerMode: true,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						},
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							centerMode: false,
						},
					},

					{
						breakpoint: 450,
						settings: {
							slidesToShow: 1,
							initialSlide: 1,
							slidesToScroll: 1,
							centerMode: false,
						},
					},
				],
			},
		};
	},
};
</script>

<style lang="scss">
.food-item {
	.food-thumbnail {
		width: 200px !important;
		height: 200px !important;
		cursor: pointer;
		transition: all 0.3s ease;
		border-radius: 10px;
		@apply flex items-center justify-center shadow-lg overflow-hidden;

		@media only screen and (max-width: 1024px) {
			width: 150px !important;
			height: 150px !important;
		}
	}

	.food-content {
		@apply mt-2;
	}
	@apply inline-block text-center font-semibold hover:text-primary-500;
}

.food-item:hover {
	.food-thumbnail {
		box-shadow: 0px 10px 10px rgb(129 72 17 / 10%);
	}
}

.slick-slide {
	text-align: center !important;
}

.slick-prev,
.slick-next {
	top: 35% !important;
	@apply text-primary-500 hover:text-primary-600;
}
</style>
