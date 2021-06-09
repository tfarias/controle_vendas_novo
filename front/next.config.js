module.exports = {
  env: {
    API_URL: 'http://tray_server/api',
    API_HOST: 'http://127.0.0.1:8000/api',
  },

  serverRuntimeConfig: {
    apiUrl: 'http://tray_server/api'
  },
  publicRuntimeConfig: {
    apiUrl: 'http://localhost:8000/api'
  }
}
