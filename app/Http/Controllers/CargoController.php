<?php

namespace App\Http\Controllers;

use App\Models\cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = cargo::all();
        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(Request $request)
    {
        // Definir las reglas de validación
        $rules = [
            'nombre' => 'required|string|max:255',
        ];
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 255 caracteres.',

        ];
        $request->validate($rules, $messages);
        Cargo::create($request->all());
        return redirect()->route('cargos.index')->with('success', 'Cargo creado con éxito');
    }

    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    public function update(Request $request, Cargo $cargo) {
        $rules = [
            'nombre' => 'required|string|max:255',
        ];
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 255 caracteres.',

        ];
        $request->validate($rules, $messages);
        $cargo->update($request->all());
        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado con éxito');
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete(); // Borrado lógico
        return redirect()->route('cargos.index')
            ->with('success', 'Cargo eliminado exitosamente');
    }
}
