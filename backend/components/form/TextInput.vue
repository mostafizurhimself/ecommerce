<template>
	<textarea rows="5" class="p-4 text-sm border border-gray-300 focus:border-primary-300 outline-none focus:ring focus:ring-primary-300 focus:ring-opacity-50 rounded-primary shadow-sm" :value="value" @input="$emit('input', $event.target.value)"></textarea>
</template>

<script>
export default {
	props: ["value"],

	emits: ["input"],
};
</script>

