<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Empresa;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = Empresa::all(['id_empresa', 'nombre']);
        return view('clientes.create', compact('empresas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'documento' => 'required|unique:cliente',
            'email' => 'required|email|unique:cliente',
        ]);

        // Crea el cliente en la base de datos
        Cliente::create($request->all());

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado exitosamente.');
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
    public function edit(Cliente $cliente)
    {
        $empresas = Empresa::all(['id_empresa', 'nombre']);
        return view('clientes.edit', compact('cliente', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',

            // La regla unique debe ignorar el documento actual del cliente que se está editando.
            // Sintaxis: unique:nombre_tabla,nombre_columna,id_a_ignorar,nombre_columna_id
            'documento' => 'required|unique:cliente,documento,' . $cliente->id_cliente . ',id_cliente',
            'email' => 'required|email|unique:cliente,email,' . $cliente->id_cliente . ',id_cliente',

            'id_empresa' => 'required|exists:empresa,id_empresa',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}