<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Usuários registrados no ponto eletrônico
    </h1>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8"></div>
    <div class="mt-8">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nome
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        CPF
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ \App\Helpers\FormatHelper::formatCpf($employee->cpf) }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div
                                class="{{ $employee->status ? 'bg-green-100 ' : 'bg-red-100 ' }} inline-block p-1 rounded-md">
                                <p
                                    class="text-gray-900 whitespace-no-wrap {{ $employee->status ? ' text-green-800' : ' text-red-600' }}">
                                    {{ $employee->status ? 'Validado' : 'Não Validado' }}
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('employee.show', $employee->name) }}"
                                class="text-indigo-600 hover:text-indigo-900">
                                VER
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($employees->isEmpty())
            <div class="px-5 py-5 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                    Nenhum usuário encontrado.
                </p>
            </div>
        @endif
    </div>
</div>
