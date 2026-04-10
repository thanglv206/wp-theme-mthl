/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{php,html,js}", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      colors: {
        milano: {
          primary: 'var(--primary)',
          secondary: 'var(--secondary)',
          muted: 'var(--muted)',
          borderPrimary: 'var(--border-primary)',
          bgPrimary: 'var(--bg-primary)',
          bgSecondary: 'var(--bg-secondary)',
          bgMuted: 'var(--bg-muted)',
          textDarkPrimary: 'var(--text-dark-primary)',
          textDarkSecondary: 'var(--text-dark-secondary)',
          textDarkMuted: 'var(--text-dark-muted)',
          textLightPrimary: 'var(--text-light-primary)',
          textLightSecondary: 'var(--text-light-secondary)',
          textLightMuted: 'var(--text-light-muted)'
        }
      }
    }
  },
  plugins: [
    require('flowbite/plugin'),
    require('postcss-import'),
    require('autoprefixer'),
  ]
}

