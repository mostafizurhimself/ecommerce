<template>
	<div>
		<div class="flex flex-col sm:flex-row justify-between sm:items-center mb-5">
			<h1 class="text-xl font-bold text-gray-900">{{title}}</h1>
			<!-- Breadcumb -->
			<div>
				<breadcrumb :breadcrumb="breadcrumb"></breadcrumb>
			</div>
		</div>
		<form @submit.prevent="$emit('submitted')">
			<div class="bg-white shadow w-full " :class="hasActions ? 'rounded-tl-primary rounded-tr-primary' : 'rounded-primary'">
				<slot name="form"></slot>
			</div>

			<div class="flex flex-col-reverse xs:flex-row xs:items-center xs:justify-end px-4 py-5 bg-gray-50 text-center sm:px-6 shadow rounded-bl-primary rounded-br-primary w-full" v-if="hasActions">
				<slot name="actions"></slot>
			</div>
		</form>

	</div>
</template>

<script>
export default {
	emits: ["submitted"],
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

	computed: {
		hasActions() {
			return !!this.$slots.actions;
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
