<?php

namespace App\Http\Controllers;

use App\Viajero;
use App\Viaje;
use App\Http\Requests\CreateViajeroRequest;
use App\Http\Requests\UpdateViajeroRequest;

use Illuminate\Http\Request;

class ViajeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //si encuentro la palabra buscar en la url que me llega via $request
        if ($request->has('buscar')) {
            //realizo busquedas por los campos ('cedula','nombre','fecha_nacimiento','telefono')
           $viajero = Viajero::where('cedula', $request->buscar)
                            ->orWhere('nombre',  'like', '%'. $request->buscar .'%')
                            ->orWhere('fecha_nacimiento', 'like', '%'. $request->buscar .'%')
                            ->orWhere('telefono', $request->buscar)
                            ->get();
        }
        //caso contrario retorno todos viajes
        else
        {
            $viajero = Viajero::all();
        }

        return json_encode($viajero);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateViajeroRequest $request)
    {
        //todo los campos que me llegan via $request
        $input = $request->all();
        
        //Si recibo el ID viaje hago el attach
        if ($request->id_viaje) {

            //Valido el id del viaje que recibo
            $viaje   = Viaje::find($request->id_viaje);

            //Si el viaje existe hago el attach
            if ($viaje)
            {
                //guardo
                $viajero = Viajero::create($input);
                $viajero->viajes()->attach($request->id_viaje);
                $mensaje = 'Viajero y Viaje almacenados satisfactoriamente';
            }
        }
        else
        {
            //guardo
            Viajero::create($input);
            $mensaje = 'Viajero almacenado satisfactoriamente';
        }    

        //retorno una respuesta json
        return response()->json([
            'res' => true,
            'message' => $mensaje
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Viajero $Viajero)
    {
        //viajes es el método que creé en el módelo Viajero
        //Obtenemos el detalle de los viajes de un viajero
        $viajero = Viajero::find($Viajero->id);
        $viajero->viajes;
        return json_encode($viajero);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViajeroRequest $request, Viajero $viajero)
    {
        //todo los campos que me llegan via $request
        $input = $request->all();

        //actualizo
        $viajero->update($input);

        //retorno una respuesta json
        return response()->json([
            'res' => true,
            'message' => 'Registro modificado satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Obtenemos los datos del viajero
        $viajero = Viajero::find($id);
        $id_viaje = 0;

        //Evaluamos si tiene viajes
        foreach ($viajero->viajes as $viajes)
            $id_viaje = $viajes->pivot->viaje_id;

        //Si tiene viajes no puede eliminar
        if ($id_viaje>0) {
            return response()->json([
                'res' => true,
                'message' => 'NO se puede eliminar, El viajero posee viajes asociados'
            ], 500);

        } else {
            //elimino
            Viajero::destroy($id);
            //retorno una respuesta json
            return response()->json([
                'res' => true,
                'message' => 'El registro se elimino satisfactoriamente'
            ], 200);
        }
 
    }
}
