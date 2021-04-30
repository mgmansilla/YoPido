<?php

namespace App\Http\Controllers;
use DB;
use App\linea;

use Illuminate\Http\Request;

class LineaController extends Controller
{
    //------------------------------ API-------------------------------
    public function index() 
    {
        $query=DB::select('SELECT * FROM `lineas`');

        $respuesta = Array(
            'error'=> FALSE,
            'lineas'=>$query
             
        );
       return $respuesta;
    }

    //------------- WEB--------------------------------------------------------

   
     public function indexWeb(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $lineas = DB::table('lineas')
            ->where('linea','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(10);
            return view('yopido.categoria.index', ['lineas' => $lineas,'searchText'=>$query]);
        }
       
    }


    public function create()
    {
        return view('yopido.categoria.create');
        
    }

    public function store(Request $request)
    {
        $linea = new linea;
        // $linea ->id =$request->get('id');
        $linea->linea= $request->get('linea');
        $linea->icono = $request->get('icono');
        $linea->save();
        return redirect('yopido/categoria/index');

    }

    public function edit($id)
    {
        
        // $linea = DB::table('lineas')->get();
        $linea = linea::findOrfail($id);
        return view ("yopido.categoria.edit",["linea"=>$linea]);
    }
    public function update($id ,Request $request)
    {
        $linea = linea::findOrfail($id);
        $linea ->linea = $request->input('linea');
        $linea ->icono = $request->input('icono');
        $linea->save();
        return redirect('yopido/categoria/index');



        
    }

    public function delete($id)
    {   
        linea::where('id', $id)->delete();

       return  redirect('yopido/categoria/index');
    }



}
