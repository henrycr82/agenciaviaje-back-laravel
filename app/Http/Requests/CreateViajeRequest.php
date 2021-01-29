<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateViajeRequest extends FormRequest
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
     
        return [
            'numero_plazas'      => 'required',
            'plazas_disponibles' => 'required',
            'origen'             => 'required|min:3|max:50',
            'destino'            => 'required|min:3|max:50',
            'precio'             => 'required',
        ];
    }

    public function messages()
    {
        return [
            'numero_plazas.required'   => 'El campo :attribute es obligatorio.',

            'plazas_disponibles.required'   => 'El campo :attribute es obligatorio.',

            'origen.required'   => 'El campo :attribute es obligatorio.',
            'origen.min'        => 'El campo :attribute debe contener mas de 3 letras.',
            'origen.max'        => 'El campo :attribute debe contener máximo 50 letras.',

            'destino.required'   => 'El campo :attribute es obligatorio.',
            'destino.min'        => 'El campo :attribute debe contener mas de 3 letras.',
            'destino.max'        => 'El campo :attribute debe contener máximo 50 letras.',
 
            'precio.required'   => 'El campo :attribute es obligatorio.',
        ];
    }

}
