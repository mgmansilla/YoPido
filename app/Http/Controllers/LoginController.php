<?php

namespace App\Http\Controllers;
use DB;
use App\login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //https://almacen-api.herokuapp.com/login?correo=franco.montti.19@gmail.com&contrasena=franco20
    public function store(Request $request)
    {
        $correo = $request->correo;
        $contrasena = $request->contrasena;
       // $id_usuario= $request ->id;
        $usuario = DB::table('login')
        ->where('correo' , $correo)
        ->where('contrasena',$contrasena)
        ->first();
        
        if ($usuario == null){
            $respuesta = array('error' => TRUE,
                                'mensaje'=>'Usuario y/o contrasena no valido' );

            
        }else{
            $token = str_random(40);
            //$usuario= $id_usuario->get('id');
            $id_usuario = DB::table('login')->where('correo', $correo)->value('id');
            $usuario = DB::table('login')
            ->where('id', $id_usuario)
            ->update(['token'=>$token]) ;
            $respuesta = array('error' => FALSE,
                                'mensaje'=>'Succes',
                                'id_usuario'=> $id_usuario,
                                 'token' => $token,
                                );
           
        }

         return $respuesta;
    }


// -----------------------------------------------------------WEB-------------------------------------------------------

    public function index()
    {
        $usuarios= DB::table('login')->paginate(10);
        return view('yopido.usuario.index',['usuarios'=>$usuarios]);
    }

    public function create()
    {
        return view('yopido.usuario.create');
    }
    public function storeWeb(Request $request)
    {
        $usuario = new login;
        $usuario->correo= $request->input('correo');
        $usuario->contrasena = $request->input('contrasena');
        $usuario->token = str_random(40);
        $usuario->save();

        return redirect('yopido/usuario/index');
    }
    public function delete($id)
    {   
        login::where('id', $id)->delete();

       return  redirect('yopido/usuario/index');
    }




}
