<template>
	<div class="w-10 flex items-center">
		<svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
	</div>
</template>

<script>
export default {
	props: {
		type: {
			type: String,
			validator: (val) =>
				val == "info" ||
				val == "warning" ||
				val == "success" ||
				val == "danger",
		},
	},
};
</script>

<style lang="scss" scoped>
</style>