<template>
	<div>
		<h2 class="font-semibold text-xl">Product Description</h2>

		<p class="mt-3 text-sm"> {{description}}
		</p>
	</div>
</template>

<script>
export default {
	props: {
		description: {
			type: String,
			default: "No description found!",
		},
	},
};
</script>

<style lang="scss" scoped>
</style>