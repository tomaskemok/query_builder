@extends('layouts.app')

@section('content')
    <form action="{{ route('crear_producto') }}" method="post" id="query_form">
        @csrf

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en q:</label>
                        <input name="incluir_q" id="incluir_q" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Excluir palabras en q:</label>
                        <input name="excluir_q" id="excluir_q" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en filter_by detalle:</label>
                        <input name="incluir_filter_by_detalle" id="incluir_filter_by_detalle" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en filter_by unidad de medida:</label>
                        <input name="incluir_filter_by_unidad" id="incluir_filter_by_unidad" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en filter_by nombre:</label>
                        <input name="incluir_filter_by_nombre" id="incluir_filter_by_nombre" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en filter_by cantidad:</label>
                        <input name="incluir_filter_by_cantidad" id="incluir_filter_by_cantidad" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en filter_by características:</label>
                        <input name="incluir_filter_by_caracteristicas" id="incluir_filter_by_caracteristicas" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Incluir palabras en filter_by tipo de recepción:</label>
                        <input name="incluir_filter_by_tipo_recepcion" id="incluir_filter_by_tipo_recepcion" type="text" class="form-control">
                    </div>
                </div>
                
                <div class="col">
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="generar_query">Generar Query</button>
                        <button type="submit" class="btn btn-success" id="crear_producto" disabled>Crear producto</button>
                    </div>

                    <div class="mb-3">
                        <label for="query" class="form-label">Query</label>
                        <textarea name="query" class="form-control" id="query" rows="12"></textarea>
                        <p class="text-danger d-none" id="error_query">El query debe tener un formato JSON valido</p>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function validarQuery(query, btn, error) {
            if (query.val()) {
                try {
                    JSON.parse(query.val());
                } catch (e) {
                    btn.prop('disabled', true);
                    error.removeClass('d-none');

                    return false;
                }

                btn.prop('disabled', false);
                error.addClass('d-none');

                return true;
            }

            btn.prop('disabled', true);
            error.addClass('d-none');

            return false;
        }

        function crearProducto(query, btn) {
            btn.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: "{{ route('crear_producto') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "q": query.val()
                },
                success: function(data) {                    
                    window.open(data.url);

                    btn.prop('disabled', false);
                }
            });
        }

        function generarJson(
            incluirQ,
            excluirQ,
            incluirFilterByDetalle,
            incluirFilterByUnidad,
            incluirFilterByNombre,
            incluirFilterByCantidad,
            incluirFilterByCaracteristicas,
            incluirFilterByTipoRecepcion,
            query
            ) {
            let formattedIncluir                    = formatIncluirQ(incluirQ.val());
            let formattedExcluir                    = formatExcluirQ(excluirQ.val());

            let filterByDetalle         = formatIncluirFilterBy(incluirFilterByDetalle.val(), 'detalle');
            let filterByUnidad          = formatIncluirFilterBy(incluirFilterByUnidad.val(), 'unidad_medida');
            let filterByNombre          = formatIncluirFilterBy(incluirFilterByNombre.val(), 'nombre');
            let filterByCantidad        = formatIncluirFilterBy(incluirFilterByCantidad.val(), 'cantidad');
            let filterByCaracteristicas = formatIncluirFilterBy(incluirFilterByCaracteristicas.val(), 'caracteristicas');
            let filterByTipoRecepcion   = formatIncluirFilterBy(incluirFilterByTipoRecepcion.val(), 'tipo_recepcion');

            let filterBy    = filterByDetalle;

            filterBy    += filterBy.length > 0 && filterByUnidad.length > 0 ? ' && ' + filterByUnidad : filterByUnidad;
            filterBy    += filterBy.length > 0 && filterByNombre.length > 0 ? ' && ' + filterByNombre : filterByNombre;
            filterBy    += filterBy.length > 0 && filterByCantidad.length > 0 ? ' && ' + filterByCantidad : filterByCantidad;
            filterBy    += filterBy.length > 0 && filterByCaracteristicas.length > 0 ? ' && ' + filterByCaracteristicas : filterByCaracteristicas;
            filterBy    += filterBy.length > 0 && filterByTipoRecepcion.length > 0 ? ' && ' + filterByTipoRecepcion : filterByTipoRecepcion;

            let queryObject = new Object();

            queryObject.q                           = formattedIncluir + " " + formattedExcluir;
            queryObject.page                        = "1";
            queryObject.group_by                    = "nog";
            queryObject.filter_by                   = filterBy;
            queryObject.per_page                    = "250";
            queryObject.query_by                    = "detalle";
            queryObject.drop_tokens_threshold       = "0";
            queryObject.num_typos                   = "0";
            queryObject.prefix                      = "false";
            
            query.val(JSON.stringify(queryObject, false, 4));
        }

        function formatIncluirQ(incluirQVal) {
            let arrTerminos = incluirQVal.split(",");
            let result = '';

            arrTerminos.forEach(termino => {
                if (termino.indexOf('"') > -1) {
                    let oracion = termino.match("(.*)")[1];

                    result += oracion;
                } else if (termino.trim()) {
                    sinonimos = getSinonimos(termino)?.join(' '); 
                    result += result.length > 0 ? ' ' + sinonimos : sinonimos;
                }
            });

            return result;
        }

        function formatIncluirFilterBy(incluirFilterByDetalleVal, text) {
            let arrTerminos = incluirFilterByDetalleVal.split(",");
            let result = '';

            arrTerminos.forEach((termino, index) => {
                if (termino.trim()) {
                    sinonimos = getSinonimos(termino)?.join(' ');
                    if (index != 0) {
                        result += ' && ' + text + ': [' + sinonimos.replace(/ /g,", ") + ']';
                    } else {
                        result += text + ': [' + sinonimos.replace(/ /g,", ") + ']';
                    }
                }
            });

            return result;
        }

        function formatExcluirQ(excluirQVal) {
            let arrTerminos = excluirQVal.split(",");
            let result = '';

            arrTerminos.forEach(termino => {
                if (termino.indexOf('"') > -1) {
                    let oracion = termino.match("(.*)")[1];

                    result += '-' + $.trim(oracion);
                } else if (termino.trim()) {
                    sinonimos = getSinonimos(termino)?.join(' '); 
                    result += '-' + sinonimos.replace(' ', ' -') + ' ';
                }
            });

            return result;
        }

        function getSinonimos(palabra) {
            let data = {
                palabra: palabra,
            };

            let result = false;

            $.ajax({
                type: 'GET',
                url:  "{{route('obtener_sinonimos')}}",
                data: data,
                async: false,  
                success: function(data) {
                    result = data.sinonimos; 
                }
            });
            
            return result;
        }

        $(function() {
            let query                               = $('#query');
            let queryForm                           = $('#query_form');
            let btnCrearProducto                    = $('#crear_producto');
            let errorQuery                          = $('#error_query');
            let generarQuery                        = $('#generar_query');
            let incluirQ                            = $('#incluir_q');
            let excluirQ                            = $('#excluir_q');
            let incluirFilterByDetalle              = $('#incluir_filter_by_detalle');
            let incluirFilterByUnidad               = $('#incluir_filter_by_unidad');
            let incluirFilterByNombre               = $('#incluir_filter_by_nombre');
            let incluirFilterByCantidad             = $('#incluir_filter_by_cantidad');
            let incluirFilterByCaracteristicas      = $('#incluir_filter_by_caracteristicas');
            let incluirFilterByTipoRecepcion        = $('#incluir_filter_by_tipo_recepcion');
            
            validarQuery(query, btnCrearProducto, errorQuery);

            query.bind('input propertychange', function() {
                validarQuery(query, btnCrearProducto, errorQuery)
            });

            generarQuery.on('click', function(e) {
                e.preventDefault();
                
                generarJson(
                    incluirQ, 
                    excluirQ, 
                    incluirFilterByDetalle, 
                    incluirFilterByUnidad,
                    incluirFilterByNombre,
                    incluirFilterByCantidad,
                    incluirFilterByCaracteristicas,
                    incluirFilterByTipoRecepcion,
                    query
                    );

                validarQuery(query, btnCrearProducto, errorQuery);
            });

            queryForm.on('submit', function(e) {
                e.preventDefault();

                crearProducto(query, btnCrearProducto)
            });
        });
    </script>
@endsection