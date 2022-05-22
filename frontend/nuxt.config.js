export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: "Our Shopping Partner",
    titleTemplate: 'Wecommerce | %s',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ['~/assets/scss/app.scss'],

  // Customize the progress-bar color
  loading: {
    color: "#8b5cf6"
  },

  // Routes Global Configuration
  router: {
    middleware: ["clearValidationErrors", "redirectToAdminDashboard"]
  },


  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/axios',
    '~/plugins/slick-slider',
    '~/plugins/mixins/global',
    {
      src: "~/plugins/star-rating",
      ssr: false
    },
    '~/plugins/vue-pagination',
    {
      src: "~/plugins/vue-infinite-loading",
      ssr: false,
    },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: [
    '~/components',
    { path: '~/components/partials', extensions: ['vue'] },
    { path: '~/components/form', extensions: ['vue'], prefix: "form" },
    { path: '~/components/icons', extensions: ['vue'] },
    { path: '~/components/shared', extensions: ['vue'], },
    { path: '~/components/views', extensions: ['vue'], },
    { path: '~/components/filters', extensions: ['vue'], },
    { path: '~/components/actions', extensions: ['vue'], },
  ],

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
    // With options
    [
      "~/modules/echo/module",
      {
        broadcaster: "pusher",
        authEndpoint: `${process.env.API_BASE_URL}/broadcasting/auth`,
        key: process.env.WEBSOCKET_KEY,
        authModule: true,
        forceTLS: true,
        disableStats: true,
        enabledTransports: ["ws", "wss"],
        cluster: "ap2"
      }
    ]
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    "@nuxtjs/auth-next",
    '@nuxtjs/toast',
    'vue-sweetalert2/nuxt'
  ],

  // Nuxt toast config
  toast: {
    position: "top-center",
    duration: 2000,
  },

  // Public runtime config
  publicRuntimeConfig: {
    apiUrl: process.env.API_URL,
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: process.env.API_URL
  },

  // Nuxt Auth Authentication strategies
  auth: {
    strategies: {
      local: {
        scope: "admin",
        token: {
          property: "access_token"
        },
        user: {
          property: "data"
        },
        endpoints: {
          login: {
            url: "/admin/login",
            method: "post"
          },
          logout: {
            url: "/admin/logout",
            method: "post"
          },
          user: {
            url: "/admin/profile",
            method: "get"
          }
        }
      },
      customer: {
        scheme: "local",
        token: {
          property: "access_token"
        },
        user: {
          property: "data"
        },
        endpoints: {
          login: {
            url: "/customer/login",
            method: "post"
          },
          logout: {
            url: "/customer/logout",
            method: "post"
          },
          user: {
            url: "/customer/profile",
            method: "get"
          }
        }
      }
    }
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
