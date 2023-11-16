<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
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

	public function register(string $name): View
	{
		$employee = Employee::where('name', $name)->first();

		if ($employee && ($employee->email === null || $employee->phone === null || $employee->knowledges === null)) {
			return view('employee-register', compact('employee'));
		}

		return view('employee-already-register');
	}

	public function show(string $name): View
	{
		$employee = Employee::where('name', $name)->first();
		$link = url('/' . $employee->name . '/registrar');
		return view('employee-show', compact('employee', 'link'));
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

			$link = url('/' . $validatedData['name'] . '/registrar');

			return response()->json(['success' => 'Funcionário criado com sucesso.', 'link' => $link]);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->errors()], 422);
		}
	}

	public function validateEmployee($id): JsonResponse
	{
		try {
			$usuario = Employee::findOrFail($id);
			$usuario->update([
				'status' => 1,
				'validated_in' => Carbon::now()
			]);

			return response()->json(['success' => 'Funcionário validado com sucesso!']);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->errors()], 422);
		} catch (\Exception $e) {
			return response()->json(['error' => 'Ocorreu um erro ao validar o funcionário.'], 500);
		}
	}

	public function update(Request $request, $id): JsonResponse
	{
		try {
			$validatedData = $request->validate([
				'email' => 'required|min:4|max:100|unique:employees,email',
				'phone' => 'required|min:12|max:15',
				'knowledges' => 'required|array|min:1|max:3'
			]);

			$usuario = Employee::findOrFail($id);
			$usuario->update($validatedData);

			return response()->json(['success' => 'Registro atualizado com sucesso!']);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->errors()], 422);
		}
	}
}
