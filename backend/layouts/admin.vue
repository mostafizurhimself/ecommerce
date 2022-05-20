<template>
	<div>
		<div class="overlay h-screen w-full lg:hidden" v-if="!collapsed" @click="collapsed = true"></div>
		<div class="flex">
			<admin-sidebar :collapsed="collapsed"></admin-sidebar>
			<div class="flex-grow overflow-x-hidden">
				<div class="min-h-screen bg-gray-100">
					<admin-header @toggle="toggleSidebar"></admin-header>
					<!-- Page Content -->
					<main class="px-4 sm:px-6 lg:px-8 py-8  overflow-y-auto w-full" style="height: calc(100vh - 80px);" scroll-region>
						<Nuxt />
					</main>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
export default {
	name: "admin-layout",
	middleware: "admin",
	data() {
		return {
			collapsed: false,
		};
	},
	methods: {
		handleResize() {
			const baseWidth = 1024;
			if (window.innerWidth <= baseWidth) {
				this.collapsed = true;
			}
		},

		toggleSidebar() {
			this.collapsed = !this.collapsed;
		},
	},

	mounted() {
		// Hide Sidebar menu in Medium device
		this.handleResize();
		// Handle Window Resize
		window.addEventListener("resize", this.handleResize);
	},
	destroyed() {
		window.removeEventListener("resize", this.handleResize);
	},
	async fetch() {
		try {
			await this.$store.dispatch("global/setGlobalValues", {
				url: "/config",
			});
		} catch (error) {
			console.error(error);
		}
	},
};
</script>

<style lang="scss">
body {
	background: #f5f5f5;
}

.btn {
	@apply inline-flex bg-white items-center px-4 py-2 shadow-md border border-transparent rounded-full text-xs uppercase tracking-widest transition;
}

.btn-primary {
	@apply bg-primary-500 text-white;
}

.btn-primary:hover {
	@apply bg-primary-600;
}

.btn-primary:focus {
	@apply bg-primary-700 outline-none ring-transparent;
}

.btn-success {
	@apply bg-green-500 text-white;
}

.btn-success:hover {
	@apply bg-green-600;
}

.btn-success:focus {
	@apply outline-none ring ring-green-300 border-green-700;
}

.btn-info {
	@apply bg-blue-500 text-white;
}

.btn-info:hover {
	@apply bg-blue-600;
}

.btn-info:focus {
	@apply outline-none ring ring-blue-300 border-blue-700;
}

.btn-warning {
	@apply bg-yellow-500 text-white;
}

.btn-warning:hover {
	@apply bg-yellow-600;
}

.btn-warning:focus {
	@apply outline-none ring ring-yellow-300 border-yellow-700;
}

.btn-danger {
	@apply bg-red-500 text-white;
}

.btn-danger:hover {
	@apply bg-red-600;
}

.btn-danger:focus {
	@apply outline-none ring ring-red-300 border-red-700;
}

.btn-light {
	@apply bg-gray-200 text-gray-800 shadow-none;
}

.btn-light:hover {
	@apply bg-gray-300;
}

.btn-light:focus {
	@apply outline-none ring ring-gray-100 border-gray-400;
}

.badge {
	@apply inline-flex items-center justify-center px-3 py-1 text-xs uppercase font-semibold leading-none text-white rounded-full;
}
</style>