<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

	private $validations = [
		'nome' => 'required|max:100',
		'email' => 'required|email|max:100|unique:usuarios',
		'cpf' => 'required|max:14',
		'celular' => 'nullable|max:15',
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

	public function store(Request $request)
	{
		$validatedData = Validator::make($request->all(), $this->validations)->validate();

		$usuario = Employee::create($validatedData);
		return redirect()->to('caminho_para_redirecionar');
	}

	public function update(Request $request, $id)
	{
		$validatedData = Validator::make($request->all(), $this->validations)->validate();

		$usuario = Employee::findOrFail($id);
		$usuario->update($validatedData);

		return redirect()->to('caminho_para_redirecionar_apos_atualizacao');
	}
}
