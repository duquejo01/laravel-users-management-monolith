<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script>
      // On page load or when changing themes, best to add inline in `head` to avoid FOUC
      const storage = localStorage.getItem('ui_settings');
      const parsedStorage = JSON.parse(storage);
      if (parsedStorage.darkMode === true || window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    </script>
    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body>
      @inertia
  </body>
</html>