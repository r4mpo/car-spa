import axios from 'axios'
export const http = axios.create({
baseURL: 'http://127.0.0.1:8000/api/' /* AQUI É COLOCADA A BASE DA ROTA DA API */
});