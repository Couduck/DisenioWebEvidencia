@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Actualizar Pedido</h1><br>

    <form action = "{{ url('/Pedido/'.$pedido->id) }}" method = "post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('Pedido.form', ['modo' => 'Editar', 'label' => 'Guardar Cambios']);
    </form>

@endsection