@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nuevo Producto</h3>

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
{{-- 
                {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true')) !!}
                {{Form::token()}} --}}

                <form action="{{url('yopido/producto/')}}" method="post" enctype="multipart/form-data">

                    {{csrf_field()}}

                <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            

                               
                                <div class="form-group">
                                    <label for="producto" class="">Nombre</label>
                                    <input type="text" name="producto" required value="{{old ('producto')}}" class="form-control " >
                                </div>
                        </div>

                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="linea_id" class="">Categoria</label>
                                    <select name="linea_id" class= "form-control" ><!-- realizo un opcion de categorias y llamo al objeto categorias y lo nombro como cat-->
                                        @foreach($lineas as $lin)

                                            <option value="{{$lin->id}}">{{$lin->linea}}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="codigo" class="">Codigo</label>
                                    <input type="text" name="codigo" required value="{{old ('codigo')}}" class="form-control "placeholder="codigo..." >
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="precio_compra" class="">Precio</label>
                                    <input type="number" step="0.01" min="0" max="999999999" name="precio_compra" required value="{{old ('precio_compra')}}" class="form-control " >
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="precio_comprado" class="">Precio Compra</label>
                                    <input type="number" step="0.01" min="0" max="999999999" name="precio_comprado" required value="{{old ('precio_comprado')}}" class="form-control " >
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="stock" class="">Stock</label>
                                    <input type="number"  name="stock" required value="{{old ('stock')}}" class="form-control " >
                                    
                                </div>
                            </div>


        {{-- 
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                        <label for="stock" class="">Stock</label>
                                        <input type="text" name="stock" required value="{{old ('stock')}}" class="form-control "placeholder="Stock del articulo..." >
                                </div>
                            </div> --}}



                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                        <label for="descripcion" class="">Imagen</label>
                                        <input type="file" name="imagen" class="form-control " >
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                               
                                <div class="form-group">
                                    <label for="descripcion" class="">Descripcion</label>
                                    <textarea  name="descripcion" required value="{{old ('descripcion')}}" class="form-control " ></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">                               
                                <div class="form-group">
                                    <label for="detalle_producto" class="">Detalle del Producto</label>
                                    <input type="text" name="detalle_producto" required value="{{old ('detalle_producto')}}" class="form-control " >
                                </div>
                            </div>


                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Guardar</button>

                        <button type="reset" class="btn btn-danger">Cancelar</button>


                    </div>
               </div>


            </form>   {{-- {!!Form::close()!!} --}}
            

@endsection
