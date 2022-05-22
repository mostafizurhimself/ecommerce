export const state = () => ({
	validationErrors: {}
});

// getters
export const getters = {
	validationErrors(state) {
		return state.validationErrors;
	}
};

// mutations
export const mutations = {
	SET_VALIDATION_ERRORS(state, validationErrors) {
		state.validationErrors = validationErrors;
		// for (const [key, value] of Object.entries(validationErrors)) {
		// 	state.validationErrors[key] = value[0];
		// }
	}
};

// actions
export const actions = {
	setErrors({ commit }, validationErrors) {
		commit("SET_VALIDATION_ERRORS", validationErrors);
	},
	clearErrors({ commit }) {
		commit("SET_VALIDATION_ERRORS", {});
	}
};
