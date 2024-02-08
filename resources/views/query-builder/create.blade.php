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
            query,
            btn,
            validarQuery,
            btnCrearProducto,
            errorQuery,
            ) {
                btn.prop('disabled', true);

                var filtersBy = {};
                filtersBy["detalle"]            = incluirFilterByDetalle.val();
                filtersBy["unidad_medida"]      = incluirFilterByUnidad.val();
                filtersBy["nombre"]             = incluirFilterByNombre.val();
                filtersBy["caracteristicas"]    = incluirFilterByCaracteristicas.val();
                filtersBy["tipo_recepcion"]     = incluirFilterByTipoRecepcion.val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('generar_query') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "incluir_q" : incluirQ.val(),
                        "excluir_q" : excluirQ.val(),
                        'filters_by': filtersBy,
                        'query_by'  : queryByValues,
                    },
                    success: function(data) {
                        query.val(JSON.stringify(data.query, false, 4));

                        btn.prop('disabled', false);

                        validarQuery(query, btnCrearProducto, errorQuery);
                    }
                });
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
                    query,
                    generarQuery,
                    validarQuery,
                    btnCrearProducto,
                    errorQuery
                    );
            });

            queryForm.on('submit', function(e) {
                e.preventDefault();

                crearProducto(query, btnCrearProducto)
            });
        });
    </script>
@endsection