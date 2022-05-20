const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  corePlugins: {
    container: false
  },
  theme: {
    screens: {
      'xs': '475px',
      ...defaultTheme.screens,
    },
    extend: {
      fontFamily: {
        sans: ["Poppins", "sans-serif"]
      },
      fontWeight: ['hover', 'focus'],
      transitionProperty: {
        width: "width",
        height: "height"
      },
      colors: {
        primary: {
          "50": "#F5F3FF",
          "100": "#f3effe",
          "200": "#ae8df9",
          "300": "#a27df8",
          "400": "#976cf7",
          "500": "#8b5cf6",
          "600": "#7d53dd",
          "700": "#6f4ac5",
          "800": "#6140ac",
          "900": "#533794"
        },
      },
      borderRadius: {
        'primary': '20px',
      },
      opacity: ['disabled'],
    }
  },
  variants: {
    extend: {}
  },
  plugins: []
};
