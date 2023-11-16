/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{php,html,js}", "./template-parts/*.{php,html,js}"],
  theme: {
    extend: {
      fontFamily: {
        'Montserrat': ['Montserrat', 'sans-serif'],
        'Roboto': ['Roboto', 'sans-serif']
      },

      colors: {
        'primary': '#093C71',
        'transparent': '#093c717d',
        'secondary':"#1A1F25",
        'text':"#1a1f2596",
        'text2':'#093C71',
        'text-white':'#ffffff9c',
      },
      height: {
        '22': '5.5rem',
        '98': '24.5rem',
        '112': '28.125rem',
        '192':'48rem'

      },
      fontSize: {
       extraSmall: "0.5rem"
      },
      maxWidth:{
        '8xl': '90rem'
      }
    },
  },
  plugins: []
};
