<template>
	<div>
		<!-- profile image -->
		<div class="flex flex-col sm:flex-row">
			<div class="mr-4">
				<form-image-input :url="$auth.user.profilePhotoUrl || '/images/users/avatar.png'" v-model="form.photo"></form-image-input>
			</div>
			<div class="mt-6 sm:mt-0">
				<h2 class="font-bold text-2xl mb-4">Profile Details</h2>
				<h6 class="font-semibold text-lg">{{$auth.user.name}}</h6>
				<p>{{$auth.user.email}}</p>
				<p>{{$auth.user.phone}}</p>
				<nuxt-link to="/customer/change-password" class="block mt-3 text-primary-500 text-sm hover:underline">Change Password</nuxt-link>
			</div>
		</div>

		<!-- details -->
		<form @submit.prevent="updateDetails" class="w-full mt-6">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- First Name -->
				<div class="">
					<form-label class="mb-2" for="firstName" value="First Name"></form-label>
					<form-input id="firstName" type="text" class="w-full" v-model="form.firstName"></form-input>
					<form-error :message="validationErrors.firstName" class="mt-2" />
				</div>
				<!-- Last Name -->
				<div class="">
					<form-label class="mb-2" for="lastName" value="Last Name"></form-label>
					<form-input id="lastName" type="text" class="w-full" v-model="form.lastName"></form-input>
					<form-error :message="validationErrors.lastName" class="mt-2" />
				</div>

				<!-- Email -->
				<div class="mt-4">
					<form-label class="mb-2" for="email" value="Email"></form-label>
					<form-input id="email" type="email" class="w-full" v-model="form.email"></form-input>
					<form-error :message="validationErrors.email" class="mt-2" />
				</div>

				<!-- Phone -->
				<div class="mt-4">
					<form-label class="mb-2" for="phone" value="Phone"></form-label>
					<form-input id="phone" type="tel" class="w-full" v-model="form.phone"></form-input>
					<form-error :message="validationErrors.phone" class="mt-2" />
				</div>
			</div>
			<form-button :class="{ 'opacity-25': isRequestProcessing }" :disabled="isRequestProcessing" class="bg-primary-500 text-white px-10 mt-4">Update</form-button>
		</form>

	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "Profile",
	mixins: [form],
	data() {
		return {
			form: {
				firstName: this.$auth.user?.firstName,
				lastName: this.$auth.user?.lastName,
				email: this.$auth.user?.email,
				phone: this.$auth.user?.phone,
				photo: null,
			},
		};
	},

	methods: {
		async updateDetails() {
			try {
				const res = await this.$axios.$post(
					"/customer/profile",
					this.form
				);
				this.$toast.success("Profile Updated successfully");
				this.$auth.setUser(res.data);
			} catch (error) {
				console.log(error);
			}
		},
	},
};
</script>