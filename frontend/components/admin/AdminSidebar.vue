<template>
	<div class="sidebar shadow-md" :class="{ collapsed: collapsed }">
		<!-- Logo -->
		<nuxt-link to="/admin" class="flex items-center justify-center px-5 h-20">
			<Logo class="block h-10 w-10" />
			<div class="ml-4 flex-grow" :class="{'lg:hidden' : collapsed}">
				<h6 class="text-lg font-bold">Wecommerce</h6>
				<span class="block text-xs tracking-wide">Admin Dashboard</span>
			</div>
		</nuxt-link>

		<ul class="px-4 overflow-auto" style="max-height: calc(100vh - 80px)">
			<admin-sidebar-item v-for="(item, index) in menu" :key="index" :menu="item" :collapsed="collapsed"></admin-sidebar-item>
		</ul>
	</div>
</template>

<script>
export default {
	props: {
		collapsed: {
			type: Boolean,
			required: true,
		},
	},
	data() {
		return {
			menu: [
				{
					href: "/admin/dashboard",
					title: "Dashboard",
					icon: "ti-home",
				},
				{
					header: true,
					title: "Resources",
				},
				{
					href: "/admin/categories",
					title: "Categories",
					icon: "ti-view-grid",
				},
				{
					href: "/admin/products",
					title: "Products",
					icon: "ti-package",
				},
				{
					href: "/admin/customers",
					title: "Customers",
					icon: "ti-user",
				},
				{
					href: "/admin/orders",
					title: "Orders",
					icon: "ti-shopping-cart",
				},
				{
					href: "/admin/deliveries",
					title: "Deliveries",
					icon: "ti-truck",
				},
			],
		};
	},
};
</script>

<style lang="scss">
.sidebar {
	@apply h-screen bg-white overflow-hidden w-72 flex-shrink-0 absolute lg:relative transition lg:transition-none duration-500 ease-in-out z-20;
	&.collapsed {
		@apply lg:w-20 transform -translate-x-full lg:translate-x-0;
	}
}
</style>
