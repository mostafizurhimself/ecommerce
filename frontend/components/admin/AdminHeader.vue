<template>
	<nav class="bg-white border-b border-gray-100 shadow-md">
		<!-- Primary Navigation Menu -->
		<div class="px-8">
			<div class="flex justify-between h-16 items-center">
				<!-- left content -->
				<div class="items-center flex" @click="$emit('toggle')">
					<menu-icon class="cursor-pointer"></menu-icon>
				</div>

				<!-- Right content -->
				<div class="flex items-center ml-6">
					<!-- Notification Dropdown -->
					<admin-notification-dropdown></admin-notification-dropdown>
					<!-- Profile Dropdown -->
					<admin-profile-dropdown class="ml-5"></admin-profile-dropdown>
				</div>

			</div>
		</div>
	</nav>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>