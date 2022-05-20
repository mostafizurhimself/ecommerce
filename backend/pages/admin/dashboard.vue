<template>
	<div>
		<h1 class="text-xl">Welcome, {{$auth.user.name}}</h1>
	</div>
</template>

<script>
export default {
	name: "dashboard",
	layout: "admin",
	head() {
		return {
			title: "Dashboard",
		};
	},
};
</script>

<style lang="scss" scoped>
</style>