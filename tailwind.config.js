/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./assets/js/**/*.js",
    "./template-parts/**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: 'rgb(var(--color-primary) / <alpha-value>)',
          container: 'rgb(var(--color-primary-container) / <alpha-value>)',
        },
        secondary: {
          DEFAULT: 'rgb(var(--color-secondary) / <alpha-value>)',
          container: 'rgb(var(--color-secondary-container) / <alpha-value>)',
        },
        surface: {
          DEFAULT: 'rgb(var(--color-surface) / <alpha-value>)',
          container: {
            lowest: 'rgb(var(--color-surface-container-lowest) / <alpha-value>)',
            low: 'rgb(var(--color-surface-container-low) / <alpha-value>)',
            DEFAULT: 'rgb(var(--color-surface-container) / <alpha-value>)',
            high: 'rgb(var(--color-surface-container-high) / <alpha-value>)',
          }
        },
        'on-surface': 'rgb(var(--color-on-surface) / <alpha-value>)',
        'on-surface-variant': 'rgb(var(--color-on-surface-variant) / <alpha-value>)',
        'on-primary': 'rgb(var(--color-on-primary) / <alpha-value>)',
        'on-secondary': 'rgb(var(--color-on-secondary) / <alpha-value>)',
        'on-secondary-container': 'rgb(var(--color-on-secondary-container) / <alpha-value>)',
        'outline': 'rgb(var(--color-outline) / <alpha-value>)',
        'outline-variant': 'rgb(var(--color-outline-variant) / <alpha-value>)',
        'error-container': 'rgb(var(--color-error-container) / <alpha-value>)',
        'on-error-container': 'rgb(var(--color-on-error-container) / <alpha-value>)',
      },
      fontFamily: {
        heading: 'var(--font-heading)',
        headline: 'var(--font-headline)',
        body: 'var(--font-body)',
        label: 'var(--font-label)',
      },
      fontSize: {
        'display-lg': '3.5rem',
        'headline-lg': '2rem',
        'headline-md': '1.75rem',
        'body-lg': '1rem',
        'label-md': '0.75rem',
      },
      boxShadow: {
        'ambient': '0 10px 40px rgba(28, 28, 25, 0.06)',
      }
    },
  },
  plugins: [],
}
