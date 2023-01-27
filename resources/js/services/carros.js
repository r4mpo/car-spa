import { http } from './config.js';

export default {

    trazerCarros: (pesquisa, pagina = null) => {
        return http.get('carros', {
            params: {
                pesquisa: pesquisa,
                page: pagina
            }
        })
    },

    salvarCarros: (carro) => {
        return http.post('carros', carro);
    },

    atualizarCarros: (carro) => {
        return http.put(`carros/${carro.id}`, carro);
    },

    excluirCarros: (carro) => {
        return http.delete(`carros/${carro.id}`, {data: carro});
    }
}