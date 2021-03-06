@extends('sisbeca.layouts.main')
@section('title','Mantenimiento Usuario')
@section('subtitle','Crear Usuario')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-user fa-fw"></span> Nuevo Usuario</div>

                <div class="panel-body">
                    <form action="{{route('mantenimientoUser.store')}}" accept-charset="UTF-8"  method="POST" >
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input class="form-control" placeholder="Nombre..." value="{{old('name')}}" required name="name" type="text" id="name">
                        </div>

                        <div class="form-group">
                            <label for="cedula">Cedula</label>
                            <input class="form-control" placeholder="Cedula..." value="{{old('cedula')}}" name="cedula" type="text" id="cedula">
                        </div>


                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control " required id="rol" name="rol">
                                <option value=''>Seleccione</option>
                                <option value='directivo'>Directivo</option>
                                <option value='editor'>Coordinador Educativo</option>
                                <option value='coordinador'>Coordinador General</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cedula">Correo Electronico</label>
                            <input class="form-control" placeholder="Email..." value="{{old('email')}}" required name="email" type="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input class="form-control" required name="password" type="password" id="password">
                        </div>

                        <div align="center" class="form-group">
                            <button onclick="Regresar()" class="btn btn-default" type="button" >Cancelar</button>&nbsp;&nbsp;

                            <input class="btn btn-primary" type="submit" value="Guardar">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('personaljs')
    <script type="text/javascript">

        function Regresar() {

            var route= "{{route('mantenimientoUser.index')}}";


            location.assign(route);

        }
    </script>
@endsection