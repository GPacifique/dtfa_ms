/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', 'sans-serif'],
      },
      screens: {
        'xs': '475px',
      },
    },
  },
  plugins: [],
  safelist: [
    'lg:ml-64',
    'lg:ml-20',
    'ml-64',
    'ml-20',
    'w-64',
    'w-20',
    'translate-x-0',
    '-translate-x-full',
    'transition-all',
  ],
}
