<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarrosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // bloqueios de acesso.
        // deixei true, pois a validação deste sistema consiste nas rotas
        // e também na camada de visualização.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'modelo' => 'required|max:100',
            'placa' => 'required|max:8',
            'cor' => 'required|max:10',
            'ano' => 'required|integer',
            'quantidade_de_parcelas' => 'nullable|integer',
            'data_de_venda' => 'nullable|date',
            'status' => 'required|max:25',
        ];
    }
}