<?php

namespace App\Http\Controllers;

use App\Viaje;
use App\Http\Requests\CreateViajeRequest;

use Illuminate\Http\Request;


class ViajeController extends Controller
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
            //realizo busquedas por los campos ('numero_plazas','plazas_disponibles','origen','destino','precio')
           $viajes = Viaje::where('numero_plazas', $request->buscar)
                            ->orWhere('plazas_disponibles', $request->buscar)
                            ->orWhere('origen',  'like', '%'. $request->buscar .'%')
                            ->orWhere('destino', 'like', '%'. $request->buscar .'%')
                            ->orWhere('precio', $request->buscar)
                            ->get();
        }
        //caso contrario retorno todos viajes
        else
        {
            $viajes = Viaje::all();
        }

        return json_encode($viajes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateViajeRequest $request)
    {

        //todo los campos que me llegan via $request
        $input = $request->all();
        
        //almaceno
        Viaje::create($input);
        
        //retorno una respuesta json
        return response()->json([
            'res' => true,
            'message' => 'Registro almacenado satisfactoriamente'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
        return json_encode($viaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateViajeRequest $request, Viaje $viaje)
    {
        //todo los campos que me llegan via $request
        $input = $request->all();

        //actualizo
        $viaje->update($input);

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
        //elimino
        //Viaje::destroy($id);
        //retorno una respuesta json
        /*return response()->json([
            'res' => true,
            'message' => 'Registro eliminado satisfactoriamente'
        ], 200);*/

        //Obtenemos los datos del viaje
        $viaje = Viaje::find($id);
        $id_viajero = 0;

        //Evaluamos si tiene viajeros
        foreach ($viaje->viajeros as $viajeros)
            $id_viajero = $viajeros->pivot->viajero_id;

        //Si tiene viajeros no puede eliminar
        if ($id_viajero>0) {
            return response()->json([
                'res' => false,
                'message' => 'NO se puede eliminar, El viaje posee viajeros asociados'
            ], 500);

        } else {
            //elimino
            Viaje::destroy($id);
            //retorno una respuesta json
            return response()->json([
                'res' => true,
                'message' => 'El registro se elimino satisfactoriamente'
            ], 200);
        }







    }

}
