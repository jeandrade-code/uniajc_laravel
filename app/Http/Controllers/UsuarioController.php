<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Empresa;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        // Arreglo [id_empresa => nombre] para mostrar el nombre de la empresa en el listado
        $empresas = Empresa::pluck('nombre', 'id_empresa');
        return view('usuarios.index', compact('usuarios', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = Empresa::all(['id_empresa', 'nombre']);
        return view('usuarios.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50|unique:usuario,username',
            'password' => 'required|min:6',
            'rol' => 'required|in:admin,vendedor,supervisor',
            'activo' => 'required|in:0,1',
            'id_empresa' => 'required|exists:empresa,id_empresa',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['fecha_creacion'] = now();

        Usuario::create($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $empresas = Empresa::all(['id_empresa', 'nombre']);
        return view('usuarios.edit', compact('usuario', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            // La regla unique debe ignorar el usuario actual que se está editando.
            'username' => 'required|max:50|unique:usuario,username,' . $usuario->id_usuario . ',id_usuario',
            // En edición la contraseña es opcional: si se deja vacía, no se cambia.
            'password' => 'nullable|min:6',
            'rol' => 'required|in:admin,vendedor,supervisor',
            'activo' => 'required|in:0,1',
            'id_empresa' => 'required|exists:empresa,id_empresa',
        ]);

        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}