<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Informações do Usuário
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Detalhes pessoais e de contato.
        </p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Nome
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $employee->name }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    E-mail
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $employee->email }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    CPF
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ \App\Helpers\FormatHelper::formatCpf($employee->cpf) }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Telefone
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if ($employee->phone)
                        {{ \App\Helpers\FormatHelper::formatPhone($employee->phone) }}
                    @endif
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Conhecimentos
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @php
                        $knowledges = json_decode($employee->knowledges, true);
                        $formattedKnowledges = is_array($knowledges) ? implode(', ', $knowledges) : '';
                    @endphp
                    {{ $formattedKnowledges }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Status
                </dt>
                <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div
                        class="{{ $employee->status ? 'bg-green-100' : ($employee->email ? 'bg-red-100' : 'bg-yellow-100') }} inline-flex items-center p-1 rounded-md">
                        <p
                            class="text-gray-900 whitespace-no-wrap {{ $employee->status ? 'text-green-800' : ($employee->email ? 'text-red-600' : 'text-yellow-600') }}">
                            @if ($employee->status)
                                VALIDADO
                            @elseif ($employee->email)
                                NÃO VALIDADO
                            @else
                                AGUARDANDO REGISTRO
                            @endif
                        </p>
                    </div>
                </dd>

                @if ($employee->email)
                    <dt class="text-sm font-medium text-gray-500">
                        Validado em
                    </dt>
                    <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $employee->validated_in ? $employee->validated_in : 'Ainda não foi validado' }}
                    </dd>
                @else
                    <dt class="text-sm mt-2 font-medium text-gray-500">
                        Link de registro
                    </dt>
                    <dd>
                        <button onclick="copyTextToClipboard('Texto para copiar')"
                            class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-0.1 text-xs mt-1 px-4 rounded">
                            Copiar Link
                        </button>
                    </dd>
                @endif
            </div>
        </dl>
    </div>
</div>
