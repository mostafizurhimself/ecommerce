<template>
	<div :title="title">
		<div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4">
			<h1 class="font-bold text-xl">{{title}}</h1>
			<!-- Breadcumb -->
			<div>
				<breadcrumb :breadcrumb="breadcrumb"></breadcrumb>
			</div>
		</div>
		<slot></slot>
	</div>
</template>

<script>
export default {
	props: {
		title: {
			type: String,
			default: "",
		},
		breadcrumb: {
			type: Array,
			default: () => [],
		},
	},
	head() {
		return {
			title: this.title,
		};
	},
};
</script>

<style lang="scss" scoped>
</style>
