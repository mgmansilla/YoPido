@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            {{-- <h3>Pedido:{{$pedido->orden_id}}</h3> --}}
            <h3>Pedido</h3>

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)

                        <li>{{$error}}</li>

                        @endforeach
                    </ul>

                </div>
                @endif
        </div>
   </div>
               
   <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="table responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    {{-- <th>Id</th> --}}
                    <th>Codigo producto</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio del Producto</th>
                    <th>Subtotal</th>


                    {{-- <th>Precio</th>
                    <th>Imagenes</th>
                    <th>Opciones</th> --}}


                </thead>
                @foreach($pedido as $ped) <!--la variable que recibo del controlador la guardo en cat y la muestro-->
                    <tr>
                        <td>{{$ped->producto_id}}</td>
                        <td>{{$ped->nombre}}</td>
                        <td>{{$ped->cantidad}}</td>
                        <td>{{$ped->precioproducto}}</td>
                        <td>{{($ped->precioproducto) * ($ped->cantidad)}}</td>
                        </td>
                    </tr>
                    {{-- @include('almacen.categoria.modal') --}}
                @endforeach


            </table>


        </div>
        {{$pedido->render()}}

    </div>

</div>

</div>



@endsection