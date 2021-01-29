<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateViajeroRequest extends FormRequest
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
            'nombre'            => 'required|min:1|max:50',
            'cedula'            => 'required|unique:viajeros',
            'fecha_nacimiento'  => 'required|date',
            'telefono'          => 'required|min:1|max:13',
        ];
    }

    
    public function messages()
    {
        return [
            'nombre.required'   => 'El campo :attribute es obligatorio.',
            'nombre.min'        => 'El campo :attribute debe contener mas de una letra.',
            'nombre.max'        => 'El campo :attribute debe contener máximo 50 letras.',

            'cedula.required'   => 'El campo :attribute es obligatorio.',
            'cedula.unique'     => 'El campo :attribute ya existe en la Base de Datos.',

            'fecha_nacimiento.required' => 'El campo :attribute es obligatorio.',
            'fecha_nacimiento.date'     => 'El campo :attribute tiene un formato invalido.',
            
            'telefono.required'   => 'El campo :attribute es obligatorio.',
            'telefono.min'        => 'El campo :attribute debe contener mas de una letra.',
            'telefono.max'        => 'El campo :attribute debe contener máximo 13 caracteres.',

        ];
    }

}
