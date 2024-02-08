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
                    
                    <div class="mb-3">
                        <label for="text" class="form-label">Query By:</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="detalle" id="queryByDetalle" checked>
                            <label class="form-check-label" for="queryByDetalle">
                                Detalle
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="entidad" id="queryByEntidad">
                            <label class="form-check-label" for="queryByEntidad">
                                Entidad
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="departamento_unidad" id="queryByDepartamentoUnidad">
                            <label class="form-check-label" for="queryByDepartamentoUnidad">
                                Departamento Unidad
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="municipio_unidad" id="queryByMunicipioUnidad">
                            <label class="form-check-label" for="queryByMunicipioUnidad">
                                Municipio Unidad
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="estatus" id="queryByEstatus">
                            <label class="form-check-label" for="queryByEstatus">
                                Estatus
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="modalidad" id="queryByModalidad">
                            <label class="form-check-label" for="queryByModalidad">
                                Modalidad
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="unidad" id="queryByUnidad">
                            <label class="form-check-label" for="queryByUnidad">
                                Unidad
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="unidad_medida" id="queryByUnidadMedida">
                            <label class="form-check-label" for="queryByUnidadMedida">
                                Unidad Medida
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="unidad_medida" id="queryByUnidadMedida">
                            <label class="form-check-label" for="queryByUnidadMedida">
                                Unidad Medida
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="nog" id="queryByNog">
                            <label class="form-check-label" for="queryByNog">
                                NOG
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="nombre" id="queryByNombre">
                            <label class="form-check-label" for="queryByNombre">
                                Nombre
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="categorias" id="queryByCategorias">
                            <label class="form-check-label" for="queryByCategorias">
                                Categorías
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="cantidad" id="queryByCantidad">
                            <label class="form-check-label" for="queryByCantidad">
                                Cantidad
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="caracteristicas" id="queryByCaracteristicas">
                            <label class="form-check-label" for="queryByCaracteristicas">
                                Características
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="tipo_recepcion" id="queryByTipoRecepcion">
                            <label class="form-check-label" for="queryByTipoRecepcion">
                                Tipo Recepción
                            </label>
                        </div>
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
            queryByValues,
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
            queryObject.query_by                    = queryByValues.join(', ');
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

                var queryByValues = $("#query_form input:checkbox:checked").map(function(){
                    return $(this).val();
                }).get();
                
                generarJson(
                    incluirQ, 
                    excluirQ, 
                    incluirFilterByDetalle, 
                    incluirFilterByUnidad,
                    incluirFilterByNombre,
                    incluirFilterByCantidad,
                    incluirFilterByCaracteristicas,
                    incluirFilterByTipoRecepcion,
                    queryByValues,
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