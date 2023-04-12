@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Crear Nuevo Producto</h1><br>

    <form action = "{{ url('/Producto') }}" method = "post" enctype="multipart/form-data">
        @csrf
        @include('Producto.form');
    </form>

@endsection