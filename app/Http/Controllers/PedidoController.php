<?php

namespace App\Http\Controllers;
use DB;
use App\pedido;
use App\Exports\Ordenes_detalleExport;
use App\Exports\OrdenesExport;
use App\Exports\Orden_DetalledeOrden;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function realizar_orden($token,$id_usuario,Request $request)
    {

        // verificar token e id del usuario

        $data = $request;

      
        //aqui validamos y decimos que el id tiene que ser igual a lo que me traiga asi como el token
        $verifica = DB::table('login')
                    ->where('token',$token)
                    ->where('id', $id_usuario)
                    ->first();

        if ($verifica == null) {
            $respuesta = array('error' => TRUE,
                                'mensaje'=>'Usuario y/o  token incorrectos' );

            return $respuesta;

            //se verifica que el pedido tenga items
        }
         if (!isset($data["items"]) || strlen($data['items'])==0) {
                $respuesta = array('error' => TRUE,
                                   'mensaje'=>'Faltan los items en el post' );
                                  
                    return $respuesta;
            }else {

                    $orden_id = DB::table('ordenes')->insertGetId(
                        ['usuario_id' => $id_usuario]);

                           $items= explode(',',$data['items']);
                           

                        for($i=0;$i<count($items);$i+=3){
                            $producto_id=$items[$i];
                            $cantidad=$items[$i+1];
                            $precioproducto=$items[$i+2];
                            $data_insertar = DB::table('ordenes_detalle')
                                        ->insertGetId(
                                            ['producto_id'=>$producto_id,
                                            'orden_id'=>$orden_id,
                                            'cantidad'=>$cantidad,
                                            'precioproducto'=>$precioproducto]);

                            $stock=DB::table('productos')
                            ->where('codigo',$producto_id)
                            ->value('stock');
                            
                            if ($cantidad > $stock) {

                                $respuesta = array('error' => TRUE,
                                   'mensaje'=>'Cantidad mayor a stock disponible por favor ingrese una cantidad menor' );
                                  
                                return $respuesta;
                            } else {
                                $actualizar_stock=DB::table('productos')
                             ->where('codigo',$producto_id)
                             ->update(['stock'=>  $stock - $cantidad ]);
                                
                            }
                                                         
                        }                              
                            $respuesta = array(
                                'mensaje'=>FALSE,
                                'orden_id'=> $orden_id,
                                'producto_id'=>$producto_id,
                                'cantidad'=>$cantidad,
                                'stock'=> $actualizar_stock
                            );

                            return $respuesta;    
        }
                                

                                    
      
    }

    public function obtener_pedidos($id_usuario,$token) 
    {
        
        $verifica = DB::table('login')
                    ->where('id', $id_usuario)
                    ->where('token',$token)
                    ->first();
                    
         if ($verifica == null) {
            $respuesta = array('error' => TRUE,
                                'mensaje'=>'Usuario y/o token incorrectos' );
                         
        }
        $query=DB::select('SELECT * FROM `ordenes` where usuario_id=' .$id_usuario. ' ORDER BY ordenes.id DESC');
        $cantidad_ordenes =DB::select('SELECT COUNT(*) FROM ordenes');
        $ordenes = array();

        foreach ($query as $row) {
            //con esta sentencia sql nos muestra los detalles de producto y relaciona la tabla orden con productos para obetener el detalle del  codigo
            $query_detalle=DB::select('SELECT a.orden_id,a.cantidad,b.* FROM `ordenes_detalle`a INNER JOIN productos b on a.producto_id = b.codigo WHERE orden_id= '.$row->id);
            $orden = array(

                'ordenes_realizadas'=>$cantidad_ordenes,
                'id'=>$row->id,
                'creado_en'=>$row->creado_en,
                'detalle'=>$query_detalle
                
            );

            //insertamos la orden
             array_push($ordenes ,$orden);
            
        }

        $respuesta = array('error'=>FALSE,
                            'ordenes'=>$ordenes
                        );

        return $respuesta;
    }

   
    //-------------------------------------------------------------------------------WEB--------------------------------------------------------------------------
    
    public function index(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $ordenes=DB::table('ordenes as o')
            ->join('login as u','o.usuario_id','=','u.id')
            ->select('o.id','u.correo as usuario','o.creado_en')
            ->orderBy('id', 'desc')
            ->where('u.correo','LIKE','%'.$query.'%')
            ->orwhere('o.creado_en','LIKE','%'.$query.'%')
            ->paginate(10);
            
            return view('yopido.pedido.index', ['ordenes' => $ordenes,'searchText'=>$query]); 
        }
    }

    // Esta funcion me realiza una sentencia sql para hacer un join con las tabla ordenes detalle y producto para sacar el nombre del producto

    public function edit($id)
    {
    
    // $pedido = DB::table('ordenes_detalle')->where('orden_id',$id)
    // ->paginate(5);
    $pedido = DB::table('ordenes_detalle as o')->where('orden_id',$id)
    ->join('productos as p','o.producto_id','=','p.codigo')
    ->select('o.producto_id','p.producto as nombre','o.cantidad','o.precioproducto')
    ->paginate(5);
    return view('yopido.pedido.edit', ['pedido'=>$pedido]);



    }

}
