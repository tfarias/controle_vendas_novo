import axios from 'axios';

const apiHost = axios.create({
  baseURL: process.env.API_HOST,
});

export default apiHost;
