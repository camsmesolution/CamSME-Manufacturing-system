// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },

  modules: [
    '@nuxtjs/tailwindcss',
    '@nuxtjs/google-fonts',
    '@pinia/nuxt',
    '@vueuse/nuxt',
    '@nuxt/icon',
  ],
  icon: {
    provider: 'iconify',
  },

  // Google Fonts (fallback if Kontumruy Pro not available locally)
  googleFonts: {
    families: {
      Inter: [400, 500, 600, 700],
    },
    display: 'swap',
  },

  // Runtime config
  runtimeConfig: {
    apiBase: process.env.NUXT_API_BASE || 'http://localhost:8000/api',
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000/api',
      apiKey: process.env.NUXT_PUBLIC_API_KEY || '',
      cookieDomain: process.env.NUXT_PUBLIC_COOKIE_DOMAIN || undefined,
    },
  },

  // App config
  app: {
    head: {
      title: 'CamSME - Manufacturing System',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { name: 'description', content: 'CamSME Manufacturing Execution System - Streamline your manufacturing operations with real-time tracking, production management, and quality control.' },
        // Open Graph / Facebook
        { property: 'og:type', content: 'website' },
        { property: 'og:url', content: process.env.NUXT_PUBLIC_SITE_URL || 'https://your-domain.com' },
        { property: 'og:title', content: 'CamSME - Manufacturing Execution System' },
        { property: 'og:description', content: 'Streamline your manufacturing operations with real-time tracking, production management, and quality control.' },
        { property: 'og:image', content: (process.env.NUXT_PUBLIC_SITE_URL || 'https://your-domain.com') + '/favicon.ico' },
        { property: 'og:site_name', content: 'CamSME' },
        // Twitter Card
        { name: 'twitter:card', content: 'summary_large_image' },
        { name: 'twitter:url', content: process.env.NUXT_PUBLIC_SITE_URL || 'https://your-domain.com' },
        { name: 'twitter:title', content: 'CamSME - Manufacturing Execution System' },
        { name: 'twitter:description', content: 'Streamline your manufacturing operations with real-time tracking, production management, and quality control.' },
        { name: 'twitter:image', content: (process.env.NUXT_PUBLIC_SITE_URL || 'https://your-domain.com') + '/favicon.ico' },
      ],
      link: [
        { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
        // Kontumruy Pro font (self-hosted or CDN)
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&display=swap'
        },
      ],
    },
  },

  // CSS
  css: ['~/assets/css/main.css'],

  // Tailwind
  tailwindcss: {
    cssPath: '~/assets/css/main.css',
    configPath: 'tailwind.config.ts',
  },

  // Pinia
  pinia: {
    storesDirs: ['./stores/**'],
  },
})
