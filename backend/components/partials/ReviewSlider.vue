<template>
	<div class="w-full mx-auto">
		<vue-slick-carousel v-bind="reviewsSettings">
			<!-- review -->
			<div v-for="(review, i) in reviews" :key="i">
				<div class="text-center px-10 md:px-20 lg:px-28">
					<p class="text-gray-900 text-sm leading-8">
						{{ review.review }}
					</p>

					<h5 class="font-semibold text-xl mt-8 text-gray-700">
						{{ review.name }}
					</h5>

					<div class="rating flex justify-center ">
						<!-- rating component -->
						<client-only>
							<star-rating :read-only="true" :star-size="15" :padding="5" :increment="0.5" :show-rating="false" active-color="#F59E0B" :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]" style="margin-top: -10px"></star-rating>
						</client-only>
					</div>
				</div>
			</div>

			<template #customPaging="page">
				<img :src="reviews[page].profilePhotoUrl">
			</template>
		</vue-slick-carousel>
	</div>
</template>

<script>
export default {
	name: "ReviewSlides",
	props: ["reviews"],

	data() {
		return {
			reviewsSettings: {
				dots: true,
				autoplay: true,
				arrows: false,
				edgeFriction: 0.35,
				infinite: true,
				speed: 500,
				pauseOnDotsHover: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				responsive: [
					{
						breakpoint: 690,
						settings: {
							arrows: false,
						},
					},
				],
			},
		};
	},
};
</script>

<style lang="scss" scope>
.slick-dots {
	margin-top: 20px !important;
	position: relative !important;
	bottom: -7px !important;
	li {
		width: 100px !important;
		height: 100px !important;
	}

	li.slick-active {
		@apply border border-primary-500;
	}
}
</style>
