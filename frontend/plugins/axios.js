export default function ({
  $axios,
  store,
  app,
  error
}) {
  $axios.onError(err => {
    if (err.response.status === 422) {
      store.dispatch("validation/setErrors", err.response.data.errors);
      // Send toast message
      app.$toast.error(err.response.data.message, {
        timeout: 2000
      });
    }

    // Check server error
    if (err.response.status === 500) {
      error({ statusCode: err.response.status, message: "Server error." })
    }

    store.dispatch("global/setRequestProcessing", false);
    return Promise.reject(err);
  });


  $axios.onRequest(() => {
    store.dispatch("validation/clearErrors");
    store.dispatch("global/setRequestProcessing", true);
  });

  $axios.onResponse(() => {
    store.dispatch("global/setRequestProcessing", false);
  });
}
