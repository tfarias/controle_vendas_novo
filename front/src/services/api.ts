import axios from 'axios';

const api = axios.create({
  baseURL: 'http://tray_server/api',
});


export default api;
