<template>
	<a :href="url" target="_blank" class="preview-image" v-if="url.length">
		<img :src="url" />
	</a>
</template>

<script>
export default {
	props: {
		url: {
			type: String,
			required: true,
		},
	},
};
</script>

<style lang="scss" scoped>
.preview-image {
	@apply bg-gray-100 p-4 rounded-primary;
	height: 150px;
	width: 200px;
	display: flex;
	align-items: center;
	justify-content: center;
	overflow: hidden;

	img {
		object-fit: contain;
		height: 100%;
		width: 100%;
	}
	margin-right: 1rem;
	margin-top: 1rem;
}
</style>
