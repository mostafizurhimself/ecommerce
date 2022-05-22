<template>
	<div>
		<div class="flex flex-col sm:flex-row justify-between sm:items-center mb-5">
			<h1 class="font-bold text-xl">{{title}}</h1>
			<!-- Breadcumb -->
			<div>
				<breadcrumb :breadcrumb="breadcrumb"></breadcrumb>
			</div>
		</div>
		<div class="w-full bg-white rounded-primary overflow-hidden">
			<!-- Default Slot -->
			<slot></slot>
		</div>

		<div class="mt-5">
			<slot name="secondary-view"></slot>
		</div>

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
