<template>
	<div>
		{{text}}<span class="text-2xl" v-if="value.length > size" @click.prevent="seeMore" role="button">...</span>
	</div>
</template>

<script>
export default {
	props: {
		value: {
			type: String,
			default: "",
		},

		length: {
			type: Number,
			default: 100,
		},
	},
	data() {
		return {
			size: null,
		};
	},
	computed: {
		text() {
			if (!this.value) return "";
			if (this.value.length <= this.size) {
				return this.value;
			}
			return this.value.substr(0, this.size);
		},
	},
	methods: {
		seeMore() {
			this.size = this.value.length;
		},
	},

	created() {
		this.size = this.length;
	},
};
</script>

<style lang="scss" scoped>
</style>