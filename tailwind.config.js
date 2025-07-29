import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    theme: {
        extend: {
          colors: {
            primary: {"50":"#fef2f2","100":"#fee2e2","200":"#fecaca","300":"#fca5a5","400":"#f87171","500":"#ef4444","600":"#dc2626","700":"#b91c1c","800":"#991b1b","900":"#7f1d1d","950":"#450a0a"}
          }
        },
    },    
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        'node_modules/preline/dist/*.js',
         "./node_modules/flowbite/**/*.js"
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('preline/plugin'),
        require('flowbite/plugin')
      ],
}
