<template>
	<li class="text-gray-800 list-none">
		<nuxt-link :to="menu.href" v-if="!isHeader" class="flex items-center p-1 hover:text-primary-400" :class="{'active': isActive}">
			<span class="flex items-center justify-center icon h-10 w-10">
				<i :class="menu.icon"></i>
			</span>
			<p class="mx-4 text-sm tracking-wider" v-if="!collapsed">
				{{menu.title}}
			</p>
		</nuxt-link>

		<!-- Header -->
		<p class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase" v-if="!collapsed && isHeader">{{menu.title}}</p>
	</li>
</template>

<script>
export default {
	props: {
		menu: {
			type: Object,
			required: true,
		},
		collapsed: {
			type: Boolean,
			required: true,
		},
	},
	data() {
		return {
			showSubmenu: false,
			isActive: false,
		};
	},
	computed: {
		isHeader() {
			return this.menu.header;
		},
	},
};
</script>

<style lang="scss" scoped>
.nuxt-link-active {
	@apply rounded-full bg-primary-100 text-primary-500;

	.icon {
		@apply bg-primary-500 text-white rounded-full shadow-lg;
	}
}
</style>