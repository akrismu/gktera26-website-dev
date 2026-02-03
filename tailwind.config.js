/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Filament/**/*.php",
    "./vendor/filament/**/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        'brand-blue': '#34a0ff',
      },
    },
  },
  plugins:  [
    require('@tailwindcss/typography'),
    require('@tailwindcss/line-clamp'),
  ],
}