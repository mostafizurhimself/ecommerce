<template>
	<div class="w-full  px-4 py-5">
		<div class="flex flex-col sm:flex-row lg:w-10/12 xl:w-9/12">
			<div class="w-full sm:w-1/4 text-sm font-medium">
				<slot name="label">
					<p>
						{{label}}
					</p>
				</slot>
			</div>
			<div class="w-full mt-2 sm:mt-0 sm:w-3/4 break-words text-sm">
				<slot>
					<p class="text-90">
						{{ value }}
					</p>
				</slot>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		label: {
			type: [String, Number],
			default: "",
		},
		value: {
			type: [String, Number],
			default: "",
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
