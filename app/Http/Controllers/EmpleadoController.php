<?php

namespace App\Http\Controllers;

use App\Models\cargo;
use App\Models\ciudad;
use App\Models\empleado;
use App\Models\pais;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = empleado::with('cargos', 'jefe', 'ciudad', 'ciudad.pais')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $cargos = Cargo::all();
        $paises = pais::all();
        return view('empleados.create', compact('empleados', 'cargos', 'paises'));
    }

    public function store(Request $request)
    {
        // Definir las reglas de validación
        $rules = [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:empleados',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'ciudad_id' => 'required|integer',
            'jefe_id' => 'nullable|exists:empleados,id',
            'cargos' => 'required|array',
            'cargos.*' => 'exists:cargos,id',
        ];
        $messages = [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.string' => 'El campo nombres debe ser una cadena de texto.',
            'nombres.max' => 'El campo nombres no puede tener más de 255 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string' => 'El campo apellidos debe ser una cadena de texto.',
            'apellidos.max' => 'El campo apellidos no puede tener más de 255 caracteres.',
            'identificacion.required' => 'El campo identificación es obligatorio.',
            'identificacion.string' => 'El campo identificación debe ser una cadena de texto.',
            'identificacion.max' => 'El campo identificación no puede tener más de 20 caracteres.',
            'identificacion.unique' => 'Ya existe un empleado con esta identificación.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo dirección no puede tener más de 255 caracteres.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo teléfono no puede tener más de 15 caracteres.',
            'ciudad_id.required' => 'El campo ciudad es obligatorio.',
            'ciudad_id.integer' => 'El campo ciudad debe ser un número válido.',
            'jefe_id.exists' => 'El jefe seleccionado no es válido.',
            'cargos.required' => 'El campo cargos es obligatorio.',
            'cargos.array' => 'El campo cargos debe ser un arreglo.',
            'cargos.*.exists' => 'El cargo seleccionado no es válido.',
        ];
        // Validar la solicitud
        $request->validate($rules, $messages);
        // Verificar si el jefe es presidente
        if ($request->jefe_id) {
            $jefe = Empleado::with('cargos')->find($request->jefe_id);
            foreach ($jefe->cargos as $cargo) {
                if ($cargo->id  == 1) {
                    return redirect()->back()->withErrors(['jefe_id' => 'El presidente no puede ser jefe de otro empleado.']);
                }
            }
        }
        // Crear el empleado
        $empleado = Empleado::create($request->all());
        // Asignar cargos
        $empleado->cargos()->attach($request->cargos);
        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito');
    }

    public function edit(Empleado $empleado)
    {
        // Obtener todos los empleados para la selección de jefe
        $empleados = Empleado::where('id', '<>', $empleado->id)->get();
        // Obtener todos los cargos para la selección en el formulario
        $cargos = Cargo::all();
        $paises = pais::all();
        $ciudades = Ciudad::where('pais_id', $empleado->ciudad->pais_id)->get(); // Obtener ciudades del país del empleado
        return view('empleados.edit', compact('empleado', 'empleados', 'cargos', 'paises', 'ciudades'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        // Definir las reglas de validación
        $rules = [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:empleados,identificacion,' . $empleado->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'ciudad_id' => 'required|integer',
            'jefe_id' => 'nullable|exists:empleados,id',
            'cargos' => 'required|array',
            'cargos.*' => 'exists:cargos,id',
        ];
        $messages = [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'identificacion.required' => 'El campo identificación es obligatorio.',
            'identificacion.unique' => 'Ya existe un empleado con esta identificación.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'ciudad_id.required' => 'El campo ciudad es obligatorio.',
            'jefe_id.exists' => 'El jefe seleccionado no es válido.',
            'cargos.required' => 'El campo cargos es obligatorio.',
            'cargos.*.exists' => 'El cargo seleccionado no es válido.',
        ];
        // Validar la solicitud
        $request->validate($rules, $messages);
        // Verificar si el jefe es presidente
        if ($request->jefe_id) {
            $jefe = Empleado::with('cargos')->find($request->jefe_id);
            foreach ($jefe->cargos as $cargo) {
                if ($cargo->id  == 1) {
                    return redirect()->back()->withErrors(['jefe_id' => 'El presidente no puede ser jefe de otro empleado.']);
                }
            }
        }
        // Actualizar el empleado
        $empleado->update($request->all());
        // Asignar cargos
        $empleado->cargos()->sync($request->cargos);
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito');
    }


    public function destroy(Empleado $empleado)
    {
        $empleado->delete(); // Borrado lógico
        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado exitosamente');
    }

    public function getCiudades($paisId)
    {
        $ciudades = ciudad::where('pais_id', $paisId)->get();
        return response()->json($ciudades);
    }
}
