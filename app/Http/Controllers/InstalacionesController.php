<?php

namespace App\Http\Controllers;

use App\Http\Requests\CambioRequest;
use App\Http\Requests\ImprocedenciaRequest;
use App\Models\Medidores;
use App\Models\OrdenesDeTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InstalacionesController extends Controller
{
    public function index($orden_id)
    {
        $medidores = Medidores::where([['usuario_id', Auth::user()->id], ['estado', false]])->count();
        if ($medidores > 0) {
            $orden = OrdenesDeTrabajo::with('comunas')->findOrFail($orden_id);
            // dd($orden);
            return view('instalaciones.index', compact('medidores', 'orden'));
        }
        return back()->withErrors('Primero debe tener medidores asignados');
    }

    public function improcedencia($orden_id)
    {
        $orden = OrdenesDeTrabajo::with('comunas')->findOrFail($orden_id);
        return view('instalaciones.improcedencia', compact('orden'));
    }

    public function cambio($orden_id)
    {
        $orden = OrdenesDeTrabajo::with('comunas')->findOrFail($orden_id);
        $medidores = Medidores::where([['usuario_id', Auth::user()->id], ['estado', false]])->get();
        // dd($orden);
        return view('instalaciones.cambio', compact('orden', 'medidores'));
    }

    public function process_improcedencia(ImprocedenciaRequest $request, $orden_id)
    {
        try {
            DB::beginTransaction();
            $orden = OrdenesDeTrabajo::findOrFail($orden_id);
            $orden->improcedencia = $request->improcedencia;
            $orden->observacion = $request->observaciones;
            foreach ($request->path_imagen as $key => $img) {
                $variable = 'imagen_' . ($key + 1);
                $orden->$variable = $img;
            }
            $orden->estado = 2; //Improcedencia
            $fecha = new \DateTime;
            $orden->fecha_cambio =  $fecha->format('Y-m-d');
            $orden->save();
            DB::commit();
            return redirect()->route('dashboard')->with('success', '¡Improcedencia registrada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function upload_image(Request $request)
    {

        try {

            $imagen_decoded = $request->img;
            $ext = $request->ext;
            $folderPath = "archivos/imagenes_instalaciones/";
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $imagen_decoded);

            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.' . $ext;
            if (file_put_contents($file, $image_base64)) {
                $ruta_final = asset($file);
                return response()->json(["result" => true, "msg" => "Archivo cargado con éxito", "archivo" => $ruta_final]);
            } else {
                return response()->json(["result" => false, "msg" => "Ha ocurrido un error, no se ha cargado el archivo"]);
            }
        } catch (\Throwable $th) {

            return response()->json(["result" => false, "msg" => "Ha ocurrido un error, no se ha cargado el archivo", "det" => $th->getMessage()]);
        }
    }

    public function calcular_rango(Request $request){
        // dd($request->all());
        try {
            $orden = OrdenesDeTrabajo::findOrFail($request->orden);
            if($request->lectura >= $orden->medidor_actual_rango_minimo && $request->lectura <= $orden->medidor_actual_rango_maximo){
                
                return response()->json(["result" => true, "msg" => "Medidor esta dentro del rango de cambio"]);
            }
            
            return response()->json(["result" => false, "msg" => "Medidor no esta dentro del rango de aceptación"]);
        } catch (\Throwable $th) {
            return response()->json(["result" => false, "msg" => "Ha ocurrido un error, no se ha calculado el la lectura"]);
        }
    }


    public function process_cambio(CambioRequest $request, $orden_id)
    {
        try {
            DB::beginTransaction();
            $orden = OrdenesDeTrabajo::findOrFail($orden_id);
            $fecha = new \DateTime;
            $orden->fecha_cambio = $fecha->format('Y-m-d');
            $orden->medidor_actual_lectura_retiro = $request->lectura_retiro;
            $orden->varales = $request->varales;
            $orden->observacion = $request->observaciones;
            $orden->rut_persona_receptora = $request->rut_cliente;
            $orden->nombre_persona_receptora = $request->nombre_cliente;
            $orden->estado = 1; //Cambio
            $medidor = Medidores::findOrFail($request->medidor);
            $orden->medidor_id = $medidor->id;
            $orden->medidor_nuevo_numero_serie = $medidor->numero;
            $orden->medidor_nuevo_diametro = $medidor->diametro;
            $orden->medidor_nuevo_ano = $medidor->ano;

            foreach ($request->path_imagen as $key => $img) {
                $variable = 'imagen_' . ($key + 1);
                $orden->$variable = $img;
            }

            $orden->save();
            DB::commit();
            return redirect()->route('dashboard')->with('success', '¡Cambio registrado con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }
}
