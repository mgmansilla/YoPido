@extends('layouts.admin')

        @section('contenido')   
            <div class="row">

    <div class="colg-lg-8 col-md-8 col-xs-12">

        <h3>Backups</h3>
            
        <a href="{{ url('yopido/backup/create') }}"><button class="btn btn-success"> Crear nuevo backup</button></a>

            
       
            {{-- @include('almacen.categoria.search') --}}
    </div>
    <style>

        .margen{
        margin-top: 50px;
        }

    </style>
    

    <div class="margen">
        <div class="col-lg-12 col-md-12 col-xs-12">

                @if (session('notification'))
                <div class="alert alert-success margen">
                    <div class="container-fluid">
                            <div class="alert-icon">
                                <i class="material-icons">Mensaje</i>
                            </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">Cerrar</i></span>
                        </button>
                            <b>Perfecto:</b>{{ session('notification') }}<li><a href="https://www.dropbox.com/home/Aplicaciones/Backups-YoPido/Laravel" target="_blank"><i class="fa fa-dropbox"></i>Dropbox</a></li>
                    </div>
                </div>
            @endif

         </div>
    </div>

        

            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="table responsive">
                        @if (count($backups))
                                <table >
                                    <thead >
                                        <tr>
                                            <th>File</th>
                                            <th>Size</th>
                                            <th>Date</th>
                                            <th>Age</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($backups as $backup)
                                            <tr>
                                                <td>{{ $backup['file_name'] }}</td>
                                                <td>{{ $backup['file_size'] }}</td>
                                                <td>
                                                    {{ date('d/M/Y, g:ia', strtotime($backup['last_modified'])) }}
                                                </td>
                                                <td>
                                                    {{ diff_date_for_humans($backup['last_modified']) }}
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-primary" href="{{ url('backup/download/'.$backup['file_name']) }}">
                                                        <i class="fas fa-cloud-download"></i> Download</a>
                                                    <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url('backup/delete/'.$backup['file_name']) }}">
                                                        <i class="fal fa-trash"></i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-5">
                                    <h1 class="text-muted">No existen backups</h1>
                                </div>
                            @endif

                    </div>
                   

                </div>

            </div> --}}


@endsection