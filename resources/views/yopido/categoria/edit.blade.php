@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar Categoria:{{$linea ->linea}}</h3>

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

                <form action="{{url('yopido/categoria/edit/'.$linea->id) }}" method="post" >
                    {{ csrf_field() }}

    <div class="row">

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="linea" class="">Nombre</label>
                    <input type="text" name="linea" required value="{{$linea->linea}}" class="form-control " >
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="icono" class="">Icono</label>
                    <input type="text" name="icono" required value="{{old('icono',$linea->icono)}}" class="form-control ">

                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    
                    <button type="reset" class="btn btn-danger">Cancelar</button>

                    <a href="{{url('yopido/categoria/index')}}"><button type="button" title="Atras" class="btn btn-info">Atras</button></a>
                    
                    
            </div>
    </div>    
</form>



@endsection