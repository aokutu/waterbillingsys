<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>My Vue.js App</title>
  <script src="https://unpkg.com/vue@next"></script>
</head>
<body>
  <div id="app">
    {{ message }}
  </div>
  <script>
    const app = Vue.createApp({
      data() {
        return {
          message: 'Hello, Vue!'
        }
      }
    })
    app.mount('#app')
  </script>
</body>
</html>