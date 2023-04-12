@if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<label for="nombreProducto">Nombre del Producto: </label>
<input type="text" name = "nombreProducto" value="{{isset($producto->nombreProducto)?$producto->nombreProducto:''}}" id = "nombreProducto">
<br>

<label for="descripcionProducto">Descripcion del Producto: </label>
<input type="text" name = "descripcionProducto" value="{{isset($producto->descripcionProducto)?$producto->descripcionProducto:''}}" id = "descripcionProducto">
<br>


<label for="fotoURLProducto">Foto del producto: </label>

@if(isset($producto->fotoURLProducto))
    <img src="{{asset('storage').'/'.$producto->fotoURLProducto}}" width="100" alt="">
@endif

<input type="file" name = "fotoURLProducto" value="{{isset($producto->fotoURLProducto)?$producto->fotoURLProducto:''}}" id = "fotoURLProducto">
<br>

<label for="precioProducto">Precio del producto: </label>
<input type="text" name = "precioProducto" value="{{isset($producto->precioProducto)?$producto->precioProducto:''}}" id = "precioProducto">
<br>

<label for="descripcionProducto">Stock del Producto: </label>
<input type="text" name = "stockProducto" value="{{isset($producto->stockProducto)?$producto->stockProducto:''}}" id = "stockProducto">
<br>
<br>

<input type="submit" value = "Guardar Datos">