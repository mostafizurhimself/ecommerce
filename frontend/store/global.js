export const state = () => ({
    isRequestProcessing: false,
    categories: null,
    countries: null,
    enums: null,
    options: null,
    featureProducts: null,
    orderStatus: [],
});

// getters
export const getters = {
    isRequestProcessing(state) {
        return state.isRequestProcessing;
    },
    getPaymentMethods(state) {
        return state.enums.paymentMethod;
    },
    getFeatureProducts(state) {
        return state.featureProducts;
    },
    getCategories(state) {
        return state.categories;
    },
    getCountries(state) {
        return state.countries;
    },
    getOrderStatus(state) {
        return state.orderStatus;
    },
    getAllOrderStatus(state) {
        return state.options?.orderStatus;
    },
};

// mutations
export const mutations = {
    SET_REQUEST_PROCESSING(state, value) {
        state.isRequestProcessing = value;
    },
    SET_GLOBAL_VALUES(state, config) {
        state.categories = config.categories;
        state.countries = config.countries;
        state.enums = config.enums;
        state.options = config.options;
        state.featureProducts = config.featureProducts;
        state.orderStatus = config.orderStatus;
    }
};

// actions
export const actions = {
    setRequestProcessing({ commit }, payload) {
        commit("SET_REQUEST_PROCESSING", payload);
    },
    async setGlobalValues({ commit }, { url }) {
        try {
            const resConfig = await this.$axios.$get(url);
            commit("SET_GLOBAL_VALUES", resConfig.data);
        } catch (error) {
            console.log(error);
        }
    }
};
