<template>
	<dropdown width="64" :align="align">
		<template #trigger>
			<button class="inline-flex bg-white text-black items-center px-6 py-3 shadow-md border border-transparent rounded-full font-semibold text-sm uppercase tracking-widest disabled:opacity-25 transition">
				<span class="mr-4 ti-calendar"></span>
				<span class="">Filters</span>
				<span class="ml-4 ti-angle-down"></span>
			</button>
		</template>

		<template #content>
			<div class="p-2">
				<slot></slot>
			</div>
		</template>
	</dropdown>
</template>

<script>
export default {
	props: {
		align: {
			type: String,
			default: "left",
		},
	},
};
</script>
