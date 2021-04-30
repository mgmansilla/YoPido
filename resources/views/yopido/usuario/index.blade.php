@extends('layouts.admin')

        @section('contenido')   
            <div class="row">

    <div class="colg-lg-8 col-md-8 col-xs-12">

        <h3>Listado de Usuarios</h3>
            {{-- @include('almacen.categoria.search') --}}
            <form method="GET" action="{{url('yopido/usuario/index')}}"  >
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
                            <span class="input-group-btn">
                                
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </span>
                    </div>
                </div>
            </form>
    </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="table responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Nombre y Apellido</th>
                                <th>Email</th>
                                <th>Opciones</th>

                            </thead>
                            @foreach($usuarios as $usuario) <!--la variable que recibo del controlador la guardo en cat y la muestro-->
                                <tr>
                                    <td>{{$usuario->nombre_completo}}</td>
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