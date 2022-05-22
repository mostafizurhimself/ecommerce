<template>
	<div class="relative" :class="{ 'overflow-hidden': loading }">
		<div v-if="loading" class="flex items-center justify-center p-5" :style="{'height': height}">
			<loader-icon></loader-icon>
		</div>

		<slot v-else />
	</div>
</template>

<script>
export default {
	props: {
		loading: {
			type: Boolean,
			default: true,
		},
		height: {
			type: String,
			default: "200px",
		},
	},
};
</script>
