export const darkMode = 'class';
// export const important = true;
export const content = [
  "./resources/**/*.blade.php",
  './app/Modules/**/Views/**/*.blade.php',
  'node_modules/preline/dist/*.js',
];
export const theme = {
  extend: {
    colors: {
      'mainColor': '#004aad',
      'mainColor2': '#ffa500'
    }
  },
};
export const plugins = [
  require('preline/plugin'),
  require('@tailwindcss/forms'),
];