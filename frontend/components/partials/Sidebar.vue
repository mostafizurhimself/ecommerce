<template>
	<ul class="sidebar px-3 shadow-md">
		<li class="nav-item">
			<nuxt-link to="/shop" class="nav-link">
				Shop
			</nuxt-link>
		</li>
		<li class="nav-item">
			<nuxt-link to="/about" class="nav-link">
				About
			</nuxt-link>
		</li>
		<li class="nav-item">
			<nuxt-link to="/policy" class="nav-link">
				Policy
			</nuxt-link>
		</li>
		<li class="nav-item" v-if="$auth.loggedIn">
			<nuxt-link to="/customer" class="nav-link">
				Profile
			</nuxt-link>
		</li>
		<li class="nav-item" v-if="$auth.loggedIn">
			<button type="button" to="/contact" class="nav-link" @click="logout">
				Logout
			</button>
		</li>
		<div class="mt-5">
			<button-link v-if="!$auth.loggedIn" class="w-full" to="/login">
				Sign In
			</button-link>
		</div>
	</ul>
</template>

<script>
export default {
	methods: {
		async logout() {
			await this.$auth.logout();
			this.$router.push("/");
		},
	},
};
</script>

<style lang="scss" scoped>
.sidebar {
	max-width: 250px;
	top: 80px;
	z-index: 100;
	@apply w-full h-full flex flex-col py-4 fixed bg-white md:hidden left-0 pt-0;

	.nav-item {
		.nav-link {
			@apply m-0 p-0 flex items-center justify-between hover:text-primary-500;
		}
		@apply py-3 px-1;
	}
	.nav-item {
		@apply border-t border-gray-200;
	}
}
</style>