<template>
	<ol class="list-reset flex text-grey-dark text-gray-500">
		<li v-for="(item, index) in breadcrumb" :key="index" class="flex text-sm tracking-wide">
			<p v-if="item.route">
				<nuxt-link :to="item.route" :class="{'text-primary-500 font-semibold': item.route}">{{item.label}}</nuxt-link>
			</p>
			<p v-else>{{item.label}}</p>
			<span class="px-2" v-if="item.route">/</span>
		</li>

	</ol>
</template>

<script>
export default {
	props: {
		breadcrumb: {
			type: Array,
			default: () => [],
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
