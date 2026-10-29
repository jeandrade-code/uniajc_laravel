<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
 
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-4">Editar Cliente: {{ $cliente->nombre }} {{ $cliente->apellido }}</h3>
                    </div>
                    <div class="card-body">
                        
                        <form method="POST" action="{{ route('clientes.update', $cliente->id_cliente) }}">
                            @csrf
                            @method('PUT')
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
 
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" type="text" placeholder="Nombre" value="{{ old('nombre', $cliente->nombre) }}" required />
                                        <label for="nombre">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" type="text" placeholder="Apellido" value="{{ old('apellido', $cliente->apellido) }}" required />
                                        <label for="apellido">Apellido</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" type="text" placeholder="Documento" value="{{ old('documento', $cliente->documento) }}" required />
                                        <label for="documento">Documento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" />
                                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    </div>
                                </div>
                            </div>
 
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email" value="{{ old('email', $cliente->email) }}" required />
                                <label for="email">Email</label>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="direccion" name="direccion" type="text" placeholder="Dirección" value="{{ old('direccion', $cliente->direccion) }}" />
                                        <label for="direccion">Dirección</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="ciudad" name="ciudad" type="text" placeholder="Ciudad" value="{{ old('ciudad', $cliente->ciudad) }}" />
                                        <label for="ciudad">Ciudad</label>
                                    </div>
                                </div>
                            </div>
 
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Teléfono" value="{{ old('telefono', $cliente->telefono) }}" />
                                        <label for="telefono">Teléfono</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select @error('id_empresa') is-invalid @enderror" id="id_empresa" name="id_empresa" required>
                                            <option value="">Seleccione una Empresa</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id_empresa }}"
                                                    {{
                                                        (old('id_empresa') == $empresa->id_empresa) ||
                                                        ($cliente->id_empresa == $empresa->id_empresa && old('id_empresa') == null)
                                                        ? 'selected' : ''
                                                    }}>
                                                    {{ $empresa->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="id_empresa">Empresa</label>
                                    </div>
                                </div>
                            </div>
 
                            <div class="mt-4 mb-0">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit">Actualizar Cliente</button>
                                    <a class="btn btn-secondary" href="{{ route('clientes.index') }}">Cancelar y Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>