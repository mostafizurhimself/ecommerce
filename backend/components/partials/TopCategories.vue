<template>
	<div class="food-categories py-10 bg-white flex justify-center items-center h-full">
		<div class="container">
			<div class="food-box bg-white rounded-primary p-6">
				<section-header>
					<template #title>Popular Categories</template>
					<template #subtitle> Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ducimus! </template>
				</section-header>
				<div class="mt-5" v-if="categories.length">
					<category-slider :categories="categories"></category-slider>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
	name: "food-categories",

	computed: {
		...mapGetters({
			categories: "global/getCategories",
		}),
	},
};
</script>

<style lang="scss" scoped>
.food-box {
	box-shadow: #7c3aed15 2px 2px 6px 2px;
}
// .food-categories {
// 	background-image: linear-gradient(
// 			rgba(255, 255, 255, 0.2),
// 			rgba(255, 255, 255, 0.2)
// 		),
// 		url("/images/banners/food-category.jpg");
// 	background-size: cover;
// }
// .food-box {
// 	@media (min-width: 1200px) {
// 		padding: 110px 70px;
// 	}
// 	@media (min-width: 576px) {
// 		padding: 60px 40px;
// 	}
// 	padding: 60px 30px;
// }
</style>
