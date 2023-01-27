<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarrosRequest;
use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrosController extends Controller
{
    public function index()
    {
        // definindo a base da pesquisa e resultados por página
        $pesquisa = request('pesquisa'); // deve-se passar um parâmetro 'pesquisa' na requisição
        $porPagina = request('porPagina'); // deve-se passar um parâmetro 'porPagina' na requisição

        $carrosPorPesquisa = Carro::where('modelo', 'like', '%' . $pesquisa . '%')
            ->orWhere('placa', 'like', '%' . $pesquisa . '%')
            ->orWhere('valor', 'like', '%' . $pesquisa . '%')
            ->orWhere('ano', 'like', '%' . $pesquisa . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(3);

        $carros = $carrosPorPesquisa->map(function ($carro) {
            return [
                'id' => $carro->id,
                'modelo' => $carro->modelo,
                'placa' => $carro->placa,
                'valor' => $carro->formatarMoedaEmReais(),
                'ano' => $carro->ano,
                'cor' => $carro->cor,
                'status' => $carro->status,
                'quantidade_de_parcelas' => $carro->quantidade_de_parcelas,
                'data_de_venda' => $carro->data_de_venda
            ];
        });

        return response()->json([
            'carros' => $carros,
            'paginaAtual' => $carrosPorPesquisa->currentPage(),
            'paginaPosterior' => $carrosPorPesquisa->nextPageUrl(),
            'paginaAnterior' => $carrosPorPesquisa->previousPageUrl(),
            'porPagina' => $porPagina,
        ]);
    }

    public function store(CarrosRequest $request)
    {
        if ($request->validated() && in_array($request->status, Carro::STATUS)) {

            try {
                $campos = $request->all();
                // $campos['user_id'] = Auth::user()->id;
                $campos['user_id'] = "1";
                $campos['valor'] = preg_replace('/\D/', '', $request->valor);
                $campos['ano'] = preg_replace('/\D/', '', $request->ano);

                if ($campos['status'] == 'Disponível') {
                    $campos['quantidade_de_parcelas'] = null;
                    $campos['data_de_venda'] = null;
                } elseif ($campos['status'] == 'Vendido') {
                    $campos['quantidade_de_parcelas'] = preg_replace('/\D/', '', $request->quantidade_de_parcelas);
                }

                $resultado = Carro::create($campos);
                $mensagem = 'Novo registro inserido com sucesso.';
                $icon = 'success';

            } catch (\Throwable $th) {
                $mensagem = 'Houve um erro inesperado.';
                $icon = 'error';
                $resultado = $th->getMessage();
            }

            return response()->json(['mensagem' => $mensagem, 'resultado' => $resultado, 'icon' => $icon]);
        } else {
            return response()->json('Ops! Parece que você preencheu algum campo de maneira incorreta.');
        }
    }

    public function show($id)
    {
        return response()->json(['carro' => Carro::findOrFail($id)]);
    }

    public function update(CarrosRequest $request, $id)
    {
        if ($request->validated() && in_array($request->status, Carro::STATUS)) {

            try {
                $campos = $request->all();
                // $campos['user_id'] = Auth::user()->id;
                $campos['user_id'] = "1";
                $campos['valor'] = preg_replace('/\D/', '', $request->valor);
                $campos['ano'] = preg_replace('/\D/', '', $request->ano);

                if ($campos['status'] == 'Disponível') {
                    $campos['quantidade_de_parcelas'] = null;
                    $campos['data_de_venda'] = null;
                } elseif ($campos['status'] == 'Vendido') {
                    $campos['quantidade_de_parcelas'] = preg_replace('/\D/', '', $request->quantidade_de_parcelas);
                }

                $resultado = Carro::findOrFail($id)->update($campos);
                $mensagem = 'Registro atualizado com sucesso.';
                $icon = 'success';
            } catch (\Throwable $th) {
                $mensagem = 'Houve um erro inesperado.';
                $icon = 'error';
                $resultado = $th->getMessage();
            }

            return response()->json(['mensagem' => $mensagem, 'resultado' => $resultado, 'icon' => $icon]);
        } else {
            return response()->json('Ops! Parece que você preencheu algum campo de maneira incorreta.');
        }

    }

    public function destroy($id)
    {
        try {
            $resultado = Carro::findOrFail($id)->delete();
            $mensagem = 'Registro excluído com sucesso.';
            $icon = 'success';
        } catch (\Throwable $th) {
            $mensagem = 'Houve um erro inesperado.';
            $icon = 'error';
            $resultado = $th->getMessage();
        }

        return response()->json(['mensagem' => $mensagem, 'resultado' => $resultado, 'icon' => $icon]);
    }
}