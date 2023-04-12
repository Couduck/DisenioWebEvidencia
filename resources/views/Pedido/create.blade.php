@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Registrar Nuevo Pedido</h1><br>

    <form action = "{{ url('/Pedido') }}" method = "post" enctype="multipart/form-data">
        @csrf
        @include('Pedido.form', ['modo' => 'Crear', 'label' => 'Guardar Pedido'])
    </form>

@endsection