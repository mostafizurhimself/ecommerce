<template>
	<footer class="footer">
		<div class="container ">
			<div class="py-10 grid md:grid-cols-2 lg:grid-cols-6 gap-7">
				<!-- column 1 -->
				<div class="order-1 lg:col-span-2">
					<!-- logo -->
					<div class="flex items-center">
						<responsive-logo></responsive-logo>
					</div>
					<p class="mt-4 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro facere voluptatem, mollitia odit.</p>

					<!-- info -->
					<div class="mt-6">
						<!-- icon 1 -->
						<div class="footer-info-item flex items-center mb-4 w-max">
							<div class="bg-white footer-info-icon rounded-full h-7 w-7 flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-primary-500" viewBox="0 0 20 20" fill="currentColor">
									<path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
								</svg>
							</div>
							<p class="ml-2 text-sm ">+001 34543 5554</p>
						</div>
						<!-- icon 2 -->
						<div class="footer-info-item flex items-center mb-4 w-max">
							<div class="bg-white footer-info-icon rounded-full h-7 w-7 flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-primary-500" viewBox="0 0 20 20" fill="currentColor">
									<path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
									<path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
								</svg>
							</div>
							<p class="ml-2 text-sm ">example@mail.com</p>
						</div>
						<!-- icon 3 -->
						<div class="footer-info-item flex items-center mb-4 w-max">
							<div class="bg-white footer-info-icon rounded-full h-7 w-7 flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-primary-500" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
								</svg>
							</div>
							<p class="ml-2 text-sm ">245 Location, Location</p>
						</div>
					</div>
				</div>
				<!-- column 2 -->
				<div class="order-2 md:order-3 lg:order-2 lg:col-span-1 md:mt-1">
					<h4 class="font-bold text-lg">Information</h4>
					<ul class="mt-1">
						<li class=" text-sm pt-3">New Products</li>
						<li class=" text-sm pt-3">Offer Products</li>
						<li class=" text-sm pt-3">Special Offer </li>
						<li class=" text-sm pt-3">Best Seller</li>
						<li class=" text-sm pt-3">
							<nuxt-link to="/terms-and-conditions">
								Terms and Conditions
							</nuxt-link>
						</li>
						<li class=" text-sm pt-3">About Our Shop</li>
					</ul>
				</div>
				<!-- column 3 -->
				<div class="order-3 md:order-4 lg:order-3 lg:col-span-1 md:mt-1">
					<h4 class="font-bold text-lg">Your Acoount</h4>
					<ul class="mt-1">
						<li class=" text-sm pt-3">Address</li>
						<li class=" text-sm pt-3">Credit slips</li>
						<li class=" text-sm pt-3">Orders</li>
						<li class=" text-sm pt-3">Personal info</li>
						<li class=" text-sm pt-3">My wishlists</li>
					</ul>
				</div>
				<!-- column 4 -->
				<div class="order-4 md:order-2 lg:order-4 lg:col-span-2 md:mt-1">
					<h4 class="font-bold text-lg">Sign Up Newsletter</h4>
					<p class="mt-4  text-sm">Get updates by subscribe or weekly newsletter</p>

					<div class="mt-7 bg-white p-1 w-max rounded-full  border border-transparent focus-within:border-primary-500">
						<input class="focus:outline-none px-3 text-sm" type="email" placeholder="Email Address">
						<button class="bg-primary-500 text-sm text-white py-2.5 px-5 rounded-full">Subscribe</button>
					</div>
				</div>

			</div>
		</div>
	</footer>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.footer-info-item:hover {
	svg {
		@apply text-white;
	}
	.footer-info-icon {
		@apply bg-primary-500;
	}
}

.footer-info-icon {
	box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 6px 0px;
}
</style>