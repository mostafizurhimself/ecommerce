<template>
	<div :class="`badge ${map[value]} text-white`">
		{{ value }}
	</div>
</template>

<script>
export default {
	props: {
		/**
		 * Avilable Value for Badge
		 */
		value: {
			type: String,
			require: true,
		},
	},
	data() {
		return {
			map: {
				pending: "pending-bg",
				processing: "processing-bg",
				shipped: "shipped-bg",
				delivered: "delivered-bg",
				rejected: "rejected-bg",
				canceled: "canceled-bg",
				refunded: "refunded-bg",
				approved: "approved-bg",
				declined: "declined-bg",
				published: "published-bg",
				unpublished: "unpublished-bg",
				active: "active-bg",
				inactive: "inactive-bg",
				resigned: "resigned-bg",
				draft: "draft-bg",
				confirmed: "confirmed-bg",
				partial: "partial-bg",
				paid: "paid-bg",
			},
		};
	},
};
</script>

<style lang="scss" scoped>
.pending-bg {
	@apply bg-yellow-100 text-yellow-500;
}

.processing-bg {
	@apply bg-indigo-100 text-indigo-500;
}

.shipped-bg {
	@apply bg-blue-100 text-blue-500;
}

.delivered-bg {
	@apply bg-green-100 text-green-500;
}

.rejected-bg {
	@apply bg-red-100 text-red-500;
}

.canceled-bg {
	@apply bg-red-100 text-red-500;
}

.approved-bg {
	@apply bg-green-100 text-green-500;
}

.declined-bg {
	@apply bg-red-100 text-red-500;
}

.published-bg {
	@apply bg-green-500 text-white;
}

.unpublished-bg {
	@apply bg-red-500 text-white;
}

.active-bg {
	@apply bg-green-500 text-white;
}

.inactive-bg {
	@apply bg-red-500 text-white;
}

.resigned-bg {
	@apply bg-red-500 text-white;
}

.draft-bg {
	@apply bg-yellow-500 text-white;
}

.confirmed-bg {
	@apply bg-indigo-500 text-white;
}

.partial-bg {
	@apply bg-purple-500 text-white;
}

.paid-bg {
	@apply bg-green-500 text-white;
}
</style>
