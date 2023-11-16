<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{

	private $validations = [
		'nome' => 'required|max:100',
		'email' => 'required|email|max:100|unique:usuarios',
		'cpf' => 'required|min:11|max:11',
		'celular' => 'required|max:15',
		'conhecimentos' => 'required|array|min:1|max:3',
	];

	public function index()
	{
		$employees = Employee::all();
		return view('registros', compact('employees'));
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
				'cpf' => 'required|min:11|max:11',
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
		$validatedData = Validator::make($request->all(), $this->validations)->validate();

		$usuario = Employee::findOrFail($id);
		$usuario->update($validatedData);

		return redirect()->to('caminho_para_redirecionar_apos_atualizacao');
	}
}
