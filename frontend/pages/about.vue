<template>
	<div class="bg-white">
		<!-- 1st section -->
		<div class="py-10">
			<div class="container bg-white lg:flex">
				<div class="lg:w-1/2  flex justify-center items-center">
					<img src="/svgs/shopping.svg" class="h-80" alt="">
				</div>
				<div class="lg:w-1/2 mt-10 lg:mt-0 flex items-center">
					<div>
						<h5 class="font-bold text-3xl lg:text-5xl">
							Trusted Organic Grocery Store Online
						</h5>
						<p class="mt-7 border-l-2 border-primary-500 pl-3 italic text-sm">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
						</p>
						<p class="mt-5 text-sm">Sellers who aspire to be good, do good and spread goodness. We democratic, self-sustaining, two-sided marketplace which thrives on trust and is built on community and quality content.</p>
					</div>
				</div>
			</div>
		</div>

		<!-- why choose us -->
		<div class="py-10 lg:py-16 bg-primary-50">
			<div class="container">
				<!-- section header -->
				<section-header>
					<template #title>
						<span class="font-bold">
							Why Choose Us
						</span>
					</template>
					<template #subtitle>
						Completely network impactful users whereas next-generation
						applications engage out thinking via tactical action.
					</template>
				</section-header>

				<!-- cards -->
				<div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-8">
					<!-- card 1 -->
					<div class="choose-us-card" v-for="(item, i) in chooseUs" :key="i">
						<div class="flex items-center">
							<div class="bg-white rounded-full h-10 w-10 p-2 border-2 border-primary-500 flex-none">
								<img :src="item.imgUrl" class="h-full w-full object-contain" alt="">
							</div>
							<h5 class="text-xl font-semibold ml-3">{{item.title}}</h5>
						</div>
						<p class="mt-5 text-sm text-justify">{{item.desc}}</p>
					</div>

				</div>
			</div>
		</div>

		<!-- faq -->
		<div class="container">
			<div class="md:w-10/12 lg:w-7/12 mx-auto my-10 lg:my-16">
				<!-- section header -->
				<section-header>
					<template #title>
						<span class="font-bold">
							Frequently Asked Questions
						</span>
					</template>
					<template #subtitle>
						Here you'll be able find answers your questions
					</template>
				</section-header>

				<div class="mt-10">
					<client-only>
						<VueFaqAccordion :items="myItems" />
					</client-only>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import VueFaqAccordion from "vue-faq-accordion";

export default {
	name: "AboutUs",
	components: { VueFaqAccordion },
	data() {
		return {
			chooseUs: [
				{
					imgUrl: "/images/icons/vegetable.png",
					title: "All Kinds of Grocery",
					desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea rerum rem temporibus iure illo error culpa, laborum totam necessitatibus magnam.",
				},
				{
					imgUrl: "images/icons/leaf.png",
					title: "Curated Products",
					desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea rerum rem temporibus iure illo error culpa, laborum totam necessitatibus magnam.",
				},
				{
					imgUrl: "images/icons/no-pesticides.png",
					title: "Pesticide Free Goods",
					desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea rerum rem temporibus iure illo error culpa, laborum totam necessitatibus magnam.",
				},
			],
			myItems: [
				{
					title: "How to buy a product?",
					value: "Given a 24-hour day and 360 degrees of longitude around the Earth",
				},
				{
					title: "How can i make refund from your website?",
					value: "Venus takes 224.7 Earth days to complete one orbit around the Sun.",
				},
				{
					title: "I am a new user. How should I start?",
					value: "Binturongs smell like popcorn.",
				},
				{
					title: "Returns and refunds",
					value: "Binturongs smell like popcorn.",
				},
				{
					title: "Are my details secured?",
					value: "Binturongs smell like popcorn.",
				},
			],
		};
	},
};
</script>

<style lang="scss">
.choose-us-card {
	@apply py-4 px-5 md:py-8 md:px-10 bg-white rounded-lg shadow-sm border-2 border-transparent hover:border-primary-500 hover:shadow transition duration-300 cursor-default;
}

.faq-wrapper {
	margin-left: auto !important;
	margin-right: auto !important;
}

.accordion {
	border: none !important;
}

.accordion__item {
	margin-top: 13px !important;
	border-bottom: none !important;

	.accordion__title {
		background-color: #f5f3ff !important;
		padding: 12px 20px !important;
		border-radius: 8px !important;
		font-weight: 500 !important;
		@apply hover:text-primary-500;
	}

	.accordion__value {
		padding: 10px 20px !important;
	}

	.accordion__toggle-button {
		transition: all 0.01s !important;
	}

	.accordion__title_active {
		color: #7c3aed !important;
	}

	.accordion__toggle-button_active::before,
	.accordion__toggle-button_active::after {
		background: #7c3aed !important;
	}
}
</style>
