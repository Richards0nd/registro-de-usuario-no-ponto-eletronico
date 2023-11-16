<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
	public function index()
	{
		$employees = Employee::all();
		return view('registros', compact('employees'));
	}

	public function register(string $name)
	{
		$employee = Employee::where('name', $name)->first();

		if ($employee && ($employee->email === null || $employee->phone === null || $employee->knowledges === null)) {
			return view('employee-register', compact('employee'));
		}

		return view('employee-already-register');
	}

	public function show(string $name)
	{
		$employee = Employee::where('name', $name)->first();
		return view('employeer', compact('employee'));
	}

	public function edit($id)
	{
		$usuario = Employee::findOrFail($id);
		return view('usuarios.edit', compact('usuario'));
	}

	public function storeTempEmployeer(Request $request): JsonResponse
	{
		try {
			$validatedData = $request->validate([
				'name' => 'required|min:2|max:100',
				'cpf' => 'required|min:11|max:11'
			]);

			if (Employee::where('cpf', $request->cpf)->exists()) {
				return response()->json(['errors' => ['cpf' => ['CPF já cadastrado']]], 422);
			}

			$employee = new Employee;
			$employee->name = $validatedData['name'];
			$employee->cpf = $validatedData['cpf'];
			$employee->status = 0;
			$employee->save();

			$registrationLink = url('/' . $validatedData['name'] . '/registrar');

			return response()->json(['success' => 'Funcionário criado com sucesso.', 'link' => $registrationLink]);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->errors()], 422);
		}
	}

	public function update(Request $request, $id)
	{
		try {
			$validatedData = $request->validate([
				'email' => 'required|min:4|max:100|unique:employees,email',
				'phone' => 'required|min:0|max:15',
				'knowledges' => 'required|array|min:2|max:3'
			]);

			$usuario = Employee::findOrFail($id);
			$usuario->update($validatedData);

			return response()->json(['success' => 'Registro atualizado com sucesso!']);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->errors()], 422);
		}
	}
}
