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
				<div class="" v-for="(blog, index) in blogs" :key="index">
					<blog-card :blog="blog"></blog-card>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			blogs: [
				{
					title: "Pure is the most healthy and most nourishing food",
					subtitle:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
					image: "/images/blogs/blog-1.jpg",
					author: "John Doe",
					date: "May 12, 2020",
					category: "Marketing",
				},
				{
					title: "Pure is the most healthy and most nourishing food",
					subtitle:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
					image: "/images/blogs/blog-2.jpg",
					author: "John Doe",
					date: "May 12, 2020",
					category: "Health",
				},
				{
					title: "Pure is the most healthy and most nourishing food",
					subtitle:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
					image: "/images/blogs/blog-3.jpg",
					author: "John Doe",
					date: "May 12, 2020",
					category: "Promotion",
				},
			],
		};
	},
};
</script>

<style lang="scss" scoped>
</style>
