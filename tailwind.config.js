/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**.{php,html,js}","./template-parts/*.{php,html,js}","./blocks/*/**.{php,html,js}"],
  theme: {
    extend: {
      fontFamily: {
        'Heebo': ['Heebo', 'sans-serif'],
        'Bebas_Neue': ['Bebas_Neue', 'sans-serif']
      },

      colors: {
        'background': "#f9f7ed"
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
