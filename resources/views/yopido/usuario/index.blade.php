@extends('layouts.admin')

        @section('contenido')   
            <div class="row">

    <div class="colg-lg-8 col-md-8 col-xs-12">

        <h3>Listado de Usuarios <a href="{{url('/yopido/usuario/create')}}" ><button class="btn btn-success">Nuevo</button></h3></a>
            {{-- @include('almacen.categoria.search') --}}
    </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="table responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                {{-- <th>Id</th> --}}
                                <th>Usuarios</th>
                                <th>Opciones</th>

                            </thead>
                            @foreach($usuarios as $usuario) <!--la variable que recibo del controlador la guardo en cat y la muestro-->
                                <tr>
                                    {{-- <td>{{$linea->id}}</td> --}}
                                    <td>{{$usuario->correo}}</td>
                                    
                                    <td>

                                       
                                      
                                        <form method="post" action="{{url('/yopido/usuario/'.$usuario->id) }}">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                           
                                            <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple">
                                                                 Eliminar
                                                               </button>
                                                                </form>
                                    
                                        </a>


                                    </td>

                                </tr>
                                {{-- @include('almacen.categoria.modal') --}}
                            @endforeach


                        </table>


                    </div>
                    {{$usuarios->render()}}

                </div>

            </div>

</div>
        @endsection