<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImprocedenciaRequest;
use App\Models\Medidores;
use App\Models\OrdenesDeTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            return redirect()->route('dashboard')->with('success', '¡Improcedencia registrada con éxito!');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
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


    public function calcular_rango(Request $request)
    {
        try {
            $orden = OrdenesDeTrabajo::findOrFail($request->orden);
            if($request->lectura > $orden->medidor_actual_rango_minimo && $request->lectura < $orden->medidor_actual_rango_maximo){
                return response()->json(['result' => true, 'msg' => "Rango dentro de lo aceptable"]);
            }else{
                return response()->json(['result' => false, 'msg' => "Rango fuera de los parametros"]);
            }
        } catch (\Throwable $th) {
            return response()->json(['result' => false, 'msg' => "Ha ocurrido un error, calculo no realizado"]);
        }
    }

    public function obtener_detalle_medidor(Request $request){
        $medidor = Medidores::findOrFail($request->medidor);
        return $medidor;
    }
}
