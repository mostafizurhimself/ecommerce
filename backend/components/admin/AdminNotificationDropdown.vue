<template>
	<dropdown :width="80">
		<template #trigger>
			<button class="ti-bell px-4 relative text-xl text-gray-800 rounded-full hover:text-primary-500 focus:outline-none focus:text-primary-600 transition duration-150 ease-in-out">
				<span class="bg-primary-500 text-white text-xs absolute w-5 h-5 rounded-full flex items-center justify-center border border-white" style="top:-5px; right: 8px" v-if="length">{{length}}</span>
			</button>
		</template>

		<template #content>
			<!-- Header -->
			<div class="p-3 border-b">
				<div class="flex items-center">
					<p class="font-semibold text-sm">
						Notifications ({{ length }})
					</p>
					<span v-if="notifications.length" role="button" @click="markAllAsRead" class="font-medium ml-auto text-sm text-primary-500 hover:underline hover:text-primary-600">Mark As Read</span>
				</div>
			</div>

			<!-- Notification List -->
			<div style="max-height: 245px; overflow: auto">
				<div v-if="notifications.length">
					<div role="button" class="border-b px-4 py-2 text-sm leading-5 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition" @click="handleClick(notification)" v-for="notification in notifications" :key="notification.id" :class="{'bg-gray-50' : notification.read_at === null}">
						<div class="">
							<p class="mb-1" :class="{
								'text-indigo-500': notification.data.type == 'info', 
								'text-green-500': notification.data.type == 'success', 
								'text-yellow-500': notification.data.type == 'warning',
								'text-red-500': notification.data.type == 'error',
								'font-semibold' : notification.read_at === null }">{{ notification.data.title }}</p>
							<p class="text-xs text-gray-700 truncate font-normal">
								{{ notification.data.subtitle }}
							</p>
						</div>
					</div>
				</div>
				<div v-else>
					<div class="text-gray-500 text-center w-full py-3 border-b text-sm">No notifications found</div>
				</div>
			</div>

			<!-- Clear Notification -->
			<div class="p-2 text-center">
				<a class="font-medium text-sm text-primary-500 hover:text-primary-600 hover:underline" href="javascript:void(0)" @click.prevent="clearAll">Clear All</a>
			</div>
		</template>
	</dropdown>
</template>

<script>
export default {
	data() {
		return {
			notifications: [],
		};
	},
	computed: {
		// Filter unread notifications
		unreadNotifications() {
			return this.notifications.filter(
				(notification) => notification.read_at === null
			);
		},

		// Get the unread notification length
		length() {
			return this.unreadNotifications.length > 9
				? "9+"
				: this.unreadNotifications.length;
		},
	},
	methods: {
		// Handle notification click event
		async handleClick(notification) {
			const res = await this.$axios.$post(
				`/admin/notifications/${notification.id}`
			);
			// Set read at
			notification.read_at = res.data.read_at;
			// Push to the link
			this.$router.push(notification.data.link);
		},

		//Mark all notifications as read
		async markAllAsRead() {
			const res = await this.$axios.$post("/admin/notifications");
			this.notifications = res.data;
			this.$toast.success("All marked as read");
		},

		//Clear all notifications
		async clearAll() {
			await this.$axios.$delete("/admin/notifications");
			this.notifications = [];
		},
	},
	mounted() {
		// Listen for new notification
		this.$echo
			.private("App.Models.User." + this.$auth.user.id)
			.notification((notification) => {
				this.notifications.unshift(notification);
				this.$toast.info(notification.data.title);
			});
	},
	async fetch() {
		const res = await this.$axios.$get("/admin/notifications");
		this.notifications = res.data;
	},
};
</script>


<style lang="scss" scoped>
</style>