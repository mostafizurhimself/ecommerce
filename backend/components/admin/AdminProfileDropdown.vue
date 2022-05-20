<template>
	<div class="relative">
		<dropdown align="right" width="48">
			<template #trigger>
				<div class="flex items-center">
					<button v-if="$auth.user.profilePhotoUrl" class="flex text-sm border-2 rounded-full focus:outline-none focus:border-gray-300 transition">
						<img class="h-8 w-8 rounded-full object-cover" :src="$auth.user.profilePhotoUrl" :alt="$auth.user.name" />
					</button>

					<span class="inline-flex rounded-md">
						<button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-800 bg-white hover:text-gray-900 focus:outline-none transition">
							{{ $auth.user.name }}

							<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
							</svg>
						</button>
					</span>
				</div>
			</template>

			<template #content>
				<!-- Account Management -->
				<nuxt-link to="/admin/profile" class="block rounded px-4 py-2 text-sm leading-5 text-gray-900 hover:bg-gray-100 hover:text-primary-500 focus:outline-none focus:bg-gray-100 transition">
					Profile
				</nuxt-link>

				<div class="border-t border-gray-100"></div>

				<nuxt-link to="/admin/change-password" class="block rounded px-4 py-2 text-sm leading-5 text-gray-900 hover:bg-gray-100 hover:text-primary-500 focus:outline-none focus:bg-gray-100 transition">
					Password
				</nuxt-link>

				<div class="border-t border-gray-100"></div>

				<!-- Authentication -->
				<button type="button" @click="logout" class="block rounded w-full px-4 py-2 text-sm leading-5 text-gray-900 text-left hover:bg-gray-100 hover:text-primary-500 focus:outline-none focus:bg-gray-100 transition">
					Logout
				</button>
			</template>
		</dropdown>
	</div>
</template>


<script>
export default {
	methods: {
		async logout() {
			await this.$auth.logout();
			this.$router.push("/admin/login");
		},
	},
};
</script>

<style lang="scss" scoped>
</style>