import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters({
            validationErrors: "validation/validationErrors",
            isRequestProcessing: "global/isRequestProcessing",
        }),
    },
    methods: {
        /**
         * Reset the specific property from data
         */
        reset(key) {
            Object.assign(this.$data[key], this.$options.data()[key]);
        },

        /**
         * Set values
         */
        setValues(form, payload, except = []) {
            for (const key in payload) {
                if (!except.includes(key)) {
                    form[key] = payload[key]
                }
            }
        }
    },
}