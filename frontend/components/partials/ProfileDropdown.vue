<template>
	<div class="flex items-center h-full px-4 lg:px-6">
		<dropdown>
			<template #trigger>
				<div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-500 text-primary-500 cursor-pointer shadow-sm flex items-center justify-center">
					<img v-if="$auth.user.profilePhotoUrl.length" :src="$auth.user.profilePhotoUrl" alt class="w-full h-full object-cover" />
					<svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
					</svg>
				</div>
			</template>

			<template #content>
				<div class="p-2 w-full">
					<nuxt-link to="/customer" class="block rounded px-4 py-2 font-medium text-sm leading-5 text-gray-900 hover:bg-gray-100 hover:text-primary-500 focus:outline-none focus:bg-gray-100 transition">
						Profile
					</nuxt-link>

					<div class="border-t border-gray-100"></div>

					<!-- Authentication -->
					<button type="button" @click="logout" class="block rounded w-full px-4 py-2 font-medium text-sm leading-5 text-gray-900 text-left hover:bg-gray-100 hover:text-primary-500 focus:outline-none focus:bg-gray-100 transition">
						Logout
					</button>
				</div>
			</template>
		</dropdown>
	</div>
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
</style>