<template>
	<div>
		<div class="bg-white rounded-primary overflow-hidden">
			<div class="px-4 py-3 border-b" v-for="(log, index) in logs" :key="index">
				<p class="text-sm">{{log.description}}</p>
				<p class="text-xs text-gray-400">{{log.dateFormatted}}</p>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		logs: {
			type: Array,
			default: () => [],
		},
	},
};
</script>

<style lang="scss" scoped>
</style>