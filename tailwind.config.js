/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**.{php,html,js}","./template-parts/*.{php,html,js}","./blocks/*/**.{php,html,js}"],
  theme: {
    extend: {
      fontFamily: {
        'Poppins': ['Poppins', 'sans-serif'],
      },

      colors: {
      },
      height: {
      },
      fontSize: {
      },
      maxWidth:{
      }
    },
  },
  plugins: []
};
