<template>

    <NavBar />

    <div class="p-10">
        <div class="row">
            <div class="col">
                <div class="input-field col">
                    <div class="row">
                        <input placeholder='Pesquisar...' v-model="filters.pesquisa" v-on:keyup.enter="preencherTabelaDeCarros()"
                            id="pesquisa" type="text" class="validate ml-10 col">
                    </div>
                    <div class="row">
                        <a class="waves-effect waves-light bg-311b92 btn col modal-trigger"
                            href="#modalAdicionarCarro"><i class="material-icons right">directions_car</i>Adicionar
                            carro</a>
                    </div>
                </div>
            </div>
        </div>
        <table class="centered highlight">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Valor</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="carro of carros" :key="carro.id">
                    <td>{{ carro.id }}</td>
                    <td>{{ carro.modelo }}</td>
                    <td>{{ carro.placa }}</td>
                    <td>{{ carro.valor }}</td>
                    <td>{{ carro.ano }}</td>
                    <td>
                        <a href="#modalAdicionarCarro" class="modal-trigger"><i @click="editar_carro(carro)"
                                class="material-icons c-blue pointer">create</i></a>
                        <i @click="excluir_carro(carro)" class="material-icons c-red pointer">delete</i>
                    </td>
                </tr>
            </tbody>
        </table>


        <div class="container center-align">
            <div class="row">
                <div class="input-field col s4">
                    <!--  -->
                </div>

                <div class="input-field col s4">
                    <ul class="pagination">
                        <li :class="{ disabled: !this.paginas.paginaAnterior }" @click="preencherTabelaDeCarros((this.paginas.paginaAnterior).substring((this.paginas.paginaAnterior).indexOf('=') + 1))"><a href="#"><i class="material-icons">chevron_left</i></a></li>
                        <li class="waves-effect active"><a href="#">{{this.paginas.paginaAtual}}</a></li>
                        <li :class="{ disabled: !this.paginas.paginaPosterior }" @click="preencherTabelaDeCarros((this.paginas.paginaPosterior).substring((this.paginas.paginaPosterior).indexOf('=') + 1))"><a href="#"><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                </div>
                <div class="input-field col s4">
                    <!--  -->
                </div>
            </div>
        </div>
    </div>

        <!-- Modal com formulário para adicionar carro -->
        <div id="modalAdicionarCarro" class="modal">
        <form @submit.prevent="salvar_carro">
            <div class="modal-content">
                <h4>Adicionar um novo carro</h4>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s3">
                            <input placeholder="Modelo" id="modelo" v-model="carro.modelo" type="text" class="validate">
                            <label class="active" for="modelo">Modelo</label>
                        </div>

                        <div class="input-field col s3">
                            <input placeholder="Placa" id="placa" v-model="carro.placa" type="text" class="validate">
                            <label class="active" for="placa">Placa</label>
                        </div>

                        <div class="input-field col s3">
                            <input placeholder="Cor" id="cor" v-model="carro.cor" type="text" class="validate">
                            <label class="active" for="cor">Cor</label>
                        </div>

                        <div class="input-field col s3">
                            <select v-model="carro.status" id="status">
                                <option v-if="carro.status != ''" :selected="true">{{
                                    carro.status
                                }}</option>
                                <option v-if="!carro.status || carro.status == ''" disabled selected value="">
                                    Selecione
                                    o status</option>
                                <option v-if="carro.status != 'Vendido'" value="Vendido">Vendido
                                </option>
                                <option v-if="carro.status != 'Disponível'" value="Disponível">
                                    Disponível</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s3">
                            <input placeholder="Valor" id="valor" onkeyup="formatarMoeda(this);" v-model="carro.valor"
                                type="text" class="validate">
                            <label class="active" for="valor">Valor</label>
                        </div>

                        <div class="input-field col s3">
                            <input placeholder="Ano" id="ano" maxlength="4" onkeypress="return apenasNumeros();"
                                v-model="carro.ano" type="text" class="validate">
                            <label class="active" for="ano">Ano</label>
                        </div>

                        <div v-if="carro.status == 'Vendido'" id="camposExtras">
                            <div class="input-field col s3">
                                <input placeholder="Qtd de parcelas" maxlength="2" onkeypress="return apenasNumeros();"
                                    id="quantidade_de_parcelas" v-model="carro.quantidade_de_parcelas" type="text"
                                    class="validate">
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Data de venda" id="data_de_venda" v-model="carro.data_de_venda"
                                    type="date" class="validate">
                                <label class="active" for="data_de_venda">Data de venda</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button @click.prevent="limparCampos()"
                        class="modal-close waves-effect waves-green btn-flat">Cancelar</button>
                    <button type="submit" class="modal-close waves-effect waves-green btn-flat">Salvar</button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>

import NavBar from "../components/NavBar.vue";
import Carros from '../services/carros.js';

export default {

    data() {
        return {
            carro: {
                id: '',
                modelo: '',
                placa: '',
                valor: '',
                ano: '',
                cor: '',
                quantidade_de_parcelas: '',
                data_de_venda: '',
                status: ''
            },

            filters: {
                pesquisa: '',
                pagina: '',
            },

            paginas: {
                paginaAtual: '',
                paginaAnterior: '',
                paginaPosterior: '',
            },

            carros: [],
        }
    },

    components: {
        NavBar,
    },

    mounted() {
        this.preencherTabelaDeCarros();
        this.recarregarModal();
        this.recarregarCamposDeSelecao();
    },

    methods: {
        preencherTabelaDeCarros(pagina = null) {
            Carros.trazerCarros(this.filters.pesquisa, pagina).then(resposta => {
                this.carros = resposta.data.carros;
                this.paginas.paginaAtual = resposta.data.paginaAtual;
                this.paginas.paginaAnterior = resposta.data.paginaAnterior;
                this.paginas.paginaPosterior = resposta.data.paginaPosterior;
            })
        },

        salvar_carro() {
            if (this.carro.id == '' || !this.carro.id) {
                Carros.salvarCarros(this.carro).then(resposta => {
                    Swal.fire(
                        'CarShop',
                        resposta.data.mensagem,
                        resposta.data.icon,
                    )
                })
            } else {
                Carros.atualizarCarros(this.carro).then(resposta => {
                    Swal.fire(
                        'CarShop',
                        resposta.data.mensagem,
                        resposta.data.icon,
                    )
                })
            }

            this.limparCampos();
            this.preencherTabelaDeCarros();
        },

        editar_carro(carro) {
            this.carro = carro;
            this.recarregarCamposDeSelecao();
        },

        excluir_carro(carro) {
            Swal.fire({
                title: 'Ops!',
                text: "Deseja realmente excluir " + carro.modelo + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, desejo excluir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Carros.excluirCarros(carro).then(resposta => {
                        Swal.fire(
                            'CarShop',
                            resposta.data.mensagem,
                            resposta.data.icon,
                        )
                        this.preencherTabelaDeCarros();
                    })
                }
            })
        },

        limparCampos() {
            this.carro.ano = '';
            this.carro.cor = '';
            this.carro.data_de_venda = '';
            this.carro.id = '';
            this.carro.modelo = '';
            this.carro.placa = '';
            this.carro.quantidade_de_parcelas = '';
            this.carro.status = '';
            this.carro.valor = '';
            this.preencherTabelaDeCarros();
            this.recarregarCamposDeSelecao();
        },

        recarregarCamposDeSelecao() {
            // Inicializando campos de seleção
            $(document).ready(function () {
                $('select').formSelect();
            });
        },

        recarregarModal() {
            // Abrindo modal - JQuery
            $(document).ready(function () {
                $('.modal').modal();
            });
        }
    },
}
</script>

<style>
/*  */
</style>