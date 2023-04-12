@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Modificar Producto</h1><br>

    <form action = "{{ url('/Producto/'.$producto->id) }}" method = "post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('Producto.form');
    </form>

@endsection