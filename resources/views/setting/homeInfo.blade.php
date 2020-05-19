@extends('layouts.master')

@section('title', 'Celia Maps')


@section('cdn')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wholePanel mt-5">
                    <div class="leftPanel">
                        <div class="content">
                            Configuración <br> General <br>
                            <img class="mt-4" src="{{url('img/icons/settings.svg')}}" alt="Sin Miniatura">
                        </div>
                    </div>
                    <div class="rightPanel">
                        <form method="POST" action="{{route('setting.updateHome')}}" enctype="multipart/form-data">
                            @csrf
                            {{-- @method("PATCH") --}}

                            <h2 class="text-success"> Metadata </h2>
                            <div class="form-group">
                                <label >Titulo de la página </label>
                                <input type="text" name="pageTitle" class="form-control" value="{{ $metadata->pageTitle }}">
                            </div>
                            <div class="form-group">
                                <label>Descripción de la página</label>
                                <textarea name="description" class="form-control">{{ $metadata->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Palabras clave de la pagina</label>
                                <textarea name="keywords" class="form-control">{{ $metadata->keywords }}</textarea>
                                <small>Separe las palabras con comas</small>
                            </div>

                            <h2 class="text-success mt-5"> Pantalla home </h2>
                            <div class="form-group">
                                <label>Subtítulo</label>
                                <input type="text" name="homeSubtitle" class="form-control" value="{{ $homeInfo->homeDescription }}">
                            </div>
                            <div class="form-group">
                                <label>Color</label>
                                <input type="color" name="homeColor" class="form-control" value="{{ $homeInfo->homeColor }}">
                            </div>
                            <div class="form-group">
                                <label>Imagen de fondo</label>
                                <input type="file" name="homeBackground" class="d-block" value="{{ $homeInfo->homeColor }}">
                            </div>
                            
                            <button type="submit" class="btn btn-success  mt-5"> Confirmar </button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script>
    document.querySelector('button[type=submit]').addEventListener('click', (e) => {
        e.preventDefault();

        let formData = getformData();
        let url = "{{route('setting.updateHome')}}";
        
        console.log(formData);

        $.ajax({
            url: url,
            method: "POST",
            data: {'_token': $('input[name=_token]').val(), data: formData},
            success: function(data) {
                alert("Información actualizada con exito");
            },
        });
    });

    function getformData() {
        const fields = document.querySelectorAll(".form-group > input, .form-group > textarea ");
        let formData = [];
        fields.forEach(field => {
            formData.push({name: field.name, value: field.value});
        });
        return formData;
    }
</script>
@endsection