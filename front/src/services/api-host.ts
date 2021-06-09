import axios from 'axios';
import getConfig from "next/config";
const { serverRuntimeConfig, publicRuntimeConfig } = getConfig();
const apiUrl = serverRuntimeConfig.apiUrl || publicRuntimeConfig.apiUrl;
const apiHost = axios.create({
  baseURL: apiUrl,
});

export default apiHost;
