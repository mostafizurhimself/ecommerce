<template>
	<div class="py-10">
		<div class="container">
			<div class="lg:flex">
				<div class="lg:w-3/12">
					<ul class="bg-white shadow-sm rounded-primary overflow-hidden border border-gray-200 divide-y devide-gray-200">
						<li class>
							<nuxt-link class="profile-link" to="/customer" exact>
								<span class="items">
									Profile
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
									</svg>
								</span>
							</nuxt-link>
						</li>
						<!-- orders -->
						<li>
							<nuxt-link class="profile-link" to="/customer/orders">
								<span class="items">
									Orders
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
										<path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
										<path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
									</svg>
								</span>
							</nuxt-link>
						</li>
						<!-- Address -->
						<li>
							<nuxt-link class="profile-link" to="/customer/address">
								<span class="items">
									Address
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
									</svg>
								</span>
							</nuxt-link>
						</li>
					</ul>
				</div>

				<div class="lg:w-9/12 lg:px-10 mt-10 lg:mt-0">
					<nuxt-child></nuxt-child>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	scrollToTop: true,
	middleware: ["auth", "customer"],
};
</script>

<style lang="scss" scoped>
.profile-link {
	@apply px-4 py-3 w-full block border-gray-200;

	.items {
		@apply flex justify-between items-center;
	}
}

.nuxt-link-active {
	@apply text-primary-500;
}
</style>
