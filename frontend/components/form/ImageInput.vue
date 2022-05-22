<template>
	<div>
		<!-- Image Preview -->
		<div class="preview bg-gray-100 border p-4 rounded-primary mb-5" v-if="previewUrl || url">
			<img :src="previewUrl || url" />
		</div>

		<!-- Add Image Button -->
		<label class="inline-block bg-primary-500 text-white px-6 py-2 rounded-full shadow whitespace-nowrap" role="button">
			<input type="file" @change="handleChange" ref="input" class="hidden" />
			<!-- Change Image -->
			<div class="flex items-center" v-if="previewUrl || url">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
				</svg>
				<span class="text-sm tracking-widest">Change Image</span>
			</div>
			<!-- Add Image -->
			<div class="flex items-center" v-else>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
				</svg>
				<span class="text-sm tracking-widest">Add New Image</span>
			</div>

		</label>

	</div>
</template>

<script>
export default {
	emits: ["input"],
	props: {
		value: {
			type: String,
			default: "",
		},
		url: {
			type: String,
			default: "",
		},
	},
	data() {
		return {
			previewUrl: "",
		};
	},

	watch: {
		previewUrl(value) {
			this.$emit("input", value);
		},

		value(value) {
			this.previewUrl = value;
		},
	},

	methods: {
		handleChange(e) {
			const files = e.target.files;
			if (files && files[0]) {
				const reader = new FileReader();
				reader.onload = (e) => {
					this.previewUrl = e.target.result;
				};
				reader.readAsDataURL(files[0]);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
.preview {
	height: 150px;
	width: 200px;
	display: flex;
	align-items: center;
	justify-content: center;
	overflow: hidden;

	img {
		height: 100%;
		object-fit: contain;
	}
}
</style>

