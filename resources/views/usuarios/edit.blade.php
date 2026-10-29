<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-4">Editar Usuario: {{ $usuario->username }}</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
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
                                        <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" placeholder="Username" value="{{ old('username', $usuario->username) }}" required />
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Nueva contraseña" />
                                        <label for="password">Nueva contraseña (opcional)</label>
                                    </div>
                                    <div class="form-text">Déjela vacía para conservar la actual.</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                                            <option value="">Seleccione un rol</option>
                                            <option value="admin" {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                            <option value="vendedor" {{ old('rol', $usuario->rol) == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                                            <option value="supervisor" {{ old('rol', $usuario->rol) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                        </select>
                                        <label for="rol">Rol</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select @error('activo') is-invalid @enderror" id="activo" name="activo" required>
                                            <option value="1" {{ (string) old('activo', $usuario->activo) === '1' ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ (string) old('activo', $usuario->activo) === '0' ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                        <label for="activo">Estado</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <select class="form-select @error('id_empresa') is-invalid @enderror" id="id_empresa" name="id_empresa" required>
                                    <option value="">Seleccione una Empresa</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id_empresa }}"
                                            {{
                                                (old('id_empresa') == $empresa->id_empresa) ||
                                                ($usuario->id_empresa == $empresa->id_empresa && old('id_empresa') == null)
                                                ? 'selected' : ''
                                            }}>
                                            {{ $empresa->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_empresa">Empresa</label>
                            </div>

                            <div class="mt-4 mb-0">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit">Actualizar Usuario</button>
                                    <a class="btn btn-secondary" href="{{ route('usuarios.index') }}">Cancelar y Volver</a>
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