<?php

namespace App\Http\Requests;

use App\Rules\NomeCompleto;
use Illuminate\Foundation\Http\FormRequest;

class VendedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $idVendedor = !empty($this->route('vendedor')) ? $this->route('vendedor')->id : null;
        return [
            'nome' => ['required', new NomeCompleto],
            'email' => "required|email|unique:vendedor,email,$idVendedor"
        ];
    }

    public function messages()
    {
        return [
            'nome.required'  => 'O nome do vendedor é obrigatório',
            'email.required' => 'O email do vendedor é obrigatório',
            'email.email'    => 'Informe um email válido',
            'email.unique'    => "Este e-mail já foi cadastrado"
        ];
    }
}
