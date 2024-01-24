@extends('layouts.master')

@section('title')
    editar orden
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('content')

    <form method="POST" action="{{ route('orders.update', $order) }}">
        
        @method('PUT')
        @csrf

        <div class="row justify-content-center px-5">

            <div class="row mt-3 px-0 py-2 form-section">

                <div class="col-md-3 px-0" id="tblrow1">
                    <h2 class="tblTitle">
                        @if ($order->isDeleted())
                            {{ __('Pedido eliminado') }}
                        @else
                            {{ __('Editar pedido') }} 
                        @endif
                    </h1>
                </div>

                <div class="col-md-9 px-0 text-end" id="tblrow2">
                    <div class="row">
                        <div class="col-sm">
                        </div>

                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <span style="color: #999999; font-weight: 700">
                                {{ __('Ultima modificación por') }} {{$order->lastUpdate->user->name . ', '.$order->lastUpdate->date }}
                            </span>
                        </div>

                        @if (($order->isAwatingForApproval() || $order->isInEdition()) && !Auth::user()->isAdmin())
                            <div class="col-md-3">
                                <button name="action" value="cancel-order" type="submit"  class="btn btn-orders-secondary mx-auto">
                                    {{ __('Cancelar pedido') }}
                                </button>
                            </div>
                        @endif
                        
                        @can('update', $order)
                            @if (Auth::user()->isAdmin() && !$order->isDeleted())
                                <div class="col-md-2">
                                    <button name="action" value="update-order" type="submit" class="btn btn-request-approval mx-auto">{{ __('Guardar') }}</button>
                                </div>

                                <div class="col-md-2 d-inline-flex justify-content-center align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="approve" @checked(old('approve')) class="form-check-input">
                                
                                        <label for="approve" class="form-check-label">{{ __('Aprobar') }}</label>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-2">
                                    <button id="update-order" style="visibility: hidden" name="action" value="update-order"  type="submit" class="btn btn-orders mx-auto">{{ __('Guardar') }}</button>
                                </div>
                            @endif
                        @endcan

                        @if (Auth::user()->isManager())
                            <div class="col-md-3">
                                <button id="request-approval" name="action" value="request-approval" type="submit" class="btn btn-request-approval mx-auto">{{ __('Solicitar aprobación') }}</button>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row mt-3 px-0 pt-2 pb-5 form-section">

                <div class="col-md-12 px-5 pb-3" id="tblrow1">
                    <h3 style="color: #950570;">{{ __('Información general') }}</h3>
                </div>
                
                <div class="col-md-3 px-5" id="tblrow1">

                    <div class="form-group">
                        <label for="id">{{ __('ID Pedido') }}</label>

                        <input type="text" name="id" class="form-control" value="{{ $order->code }}" readonly>
                    </div>

                </div>
                
                <div class="col-md-3 px-5" id="tblrow1">

                    <div class="form-group">
                        <label for="country_id">{{ __('País') }}</label>

                        <select name="country_id" id="" disabled="disabled"  class="form-select tblDropdown w-100">
                            <option value="{{ $order->country->id }}">
                                {{ $order->country->name }}
                            </option>
                        </select>
                    </div>

                </div>
                
                <div class="col-md-3 px-5" id="tblrow1">

                    <div class="form-group">
                        <label for="date">{{ __('Fecha') }}</label>

                        <input type="text" name="date" value="{{ $order->formattedCreationDate }}" class="form-control" readonly>
                    </div>

                </div>
                
                <div class="col-md-3 px-5" id="tblrow1">

                    <div class="form-group">
                        <label for="distributor_id">{{ __('Distribuidor') }}</label>
                        
                        <select name="distributor_id" class="form-select tblDropdown w-100">
                            <option value="0" selected>
                                --
                            </option>
                            @foreach ($distributors as $distributor)
                                <option 
                                    @if (old('distributor_id') == $distributor->id) selected @elseif($order->distributor_id == $distributor->id) selected @endif
                                    value="{{ $distributor->id }}">
                                    {{ $distributor->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        @if ($order->distributor->trashed())
                            <button style="color: #950570; border: none; background: none; position: absolute; right: 10px" data-toggle="tooltip" data-placement="top" title="Este distribuidor ha sido deshabilitado">
                                *
                            </button >
                        @endif
                    </div>

                </div>
                
                <div class="col-md-3 px-5 py-3" id="tblrow1">

                    <div class="form-group">
                        <label for="buy_order">{{ __('Orden de compra') }}</label>

                        <input type="text" name="buy_order" class="form-control" value="{{ $order->buy_order }}">

                        @error('buy_order')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                
                <div class="col-md-3 px-5 py-3" id="tblrow1">

                    <div class="form-group">
                        <label for="order_type">{{ __('Tipo de pedido') }}</label>

                        <select class="form-select tblDropdown w-100" name="order_type" id="" disabled="disabled">
                            <option value="{{ $order->order_type }}">
                                {{ $order->order_type }}
                            </option>
                        </select>
                    </div>

                </div>
                
                <div class="col-md-3 px-5 py-3" id="tblrow1">

                    <div class="form-group">
                        <label for="commercial_type">{{ __('Mes de facturación') }}</label>

                        <select name="billing_month" class="form-select tblDropdown w-100">
                            <option value="">
                                --
                            </option>
                            @foreach ($months as $key => $month)
                                <option
                                    @if (old('billing_month') == $key) selected @elseif($order->formatted_value_billing_month == $key) selected @endif
                                    value="{{ $key }}"
                                    >
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>

                        @error('billing_month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        3    </span>
                        @enderror
                    </div>

                </div>
                
                <div class="col-md-3 px-5 py-3" id="tblrow1">

                    <div class="form-group">
                        <label for="commercial_type">{{ __('Tipo comercial') }}</label>

                        <select name="commercial_type" class="form-select tblDropdown w-100">
                            <option value="">
                                --
                            </option>
                            @foreach (\App\Enums\CommercialType::cases() as $commercial_type)
                                <option 
                                    @if (old('commercial_type') == $commercial_type->value) selected @elseif($order->commercial_type == $commercial_type->value) selected @endif 
                                    value="{{ $commercial_type }}">
                                    {{ $commercial_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                
                <div class="col-md-12 px-5" id="tblrow1">

                    <div class="form-group">
                        <label for="observations">{{ __('Observaciones') }}</label>

                        <input type="text" name="observations" class="form-control" value="{{ $order->observations }}">
                    </div>

                </div>
                
                <div class="col-md-12 px-5 pt-3" id="tblrow1">

                    <div class="form-group">
                        <label for="admin_notes">{{ __('Notas del administrador') }}</label>

                        <input type="text" name="admin_notes" class="form-control" value="{{ $order->admin_notes }}" {{ ($order->isAwatingForApproval() && Auth::user()->isAdmin()) || ($order->user_id == Auth::user()->id && Auth::user()->isAdmin()) ? '' : 'readonly' }}>
                    </div>

                </div>

            </div>

            <div class="row mt-3 px-0 pt-2 pb-5">

                <div class="col-md-12 px-5 pb-3" id="tblrow1">
                    <h3 style="color: #950570;">{{ __('Productos de pedido') }}</h3>
                </div>

                <div id="products-order-table">
                    @foreach ($order->products()->orderBy('order_product_variation_countries.id')->get() as $key => $presentation)
                        @include('orders._partials.presentation_row', [
                            'presentations_country' => $presentations,
                            'selected_presentation' => $presentation,
                            'counter' => $key + 1
                        ])
                    @endforeach
                </div>

                @if (!$order->isDeleted())
                    <div id="add-presentation" class="col-md-12 px-5 py-3 box box-d">
                        <a onclick="addPresentation(event)" href="#">
                            {{ __('+ Agregar presentación') }}
                        </a>
                    </div> 
                @endif
                @error('presentations')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @error('health_records_error')
                    <span class="invalid-feedback d-flex w-100 justify-content-center mt-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="col-md-12 py-3 px-5 mt-5" style="background: #F2F2F2; text-align: right;" id="tblrow1">
                    <span>{{ __('Total pedido') }}</span>
                    <span id="total_order" style="font-weight: 700;">
                        {{ __('$ 0.00') }}
                    </span>
                </div>

            </div>

            <input type="hidden" name="presentations" id="presentations">

        </div>
        
    </form>

    @if (Session::has('products'))

        @include('orders._partials.health_records_modal', ['products' => Session::get('products')])
        
    @endif

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/edit_page.css') }}">
    @endsection

    @if ($order->isDeleted())
        <script>
            $(document).ready(function() {
                $('#products-order-table input').prop( "disabled", true )
                $('#products-order-table .close').hide()
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#update-order').css('visibility', 'hidden');
            $("select, input").on("keyup change", function(e) {
                if (e.originalEvent) {
                    $('#update-order').css('visibility', 'visible');
                    $('#request-approval').css('visibility', 'hidden');
                }
            })
            $("#add-presentation a").on("click", function(e) {
                $('#update-order').css('visibility', 'visible');
                $('#request-approval').css('visibility', 'hidden');
            })
        })
    </script>

    @include('orders._partials.js_functions')

@endsection