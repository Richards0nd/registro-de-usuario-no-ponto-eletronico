<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-add-employee-modal />
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-medium text-gray-900">
            Usuários registrados no ponto eletrônico
        </h1>
        <button onclick="showModal()"
            class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Novo Usuário
        </button>
    </div>
    <div id="actionMessage" class="text-sm text-green-400" style="display: none;">
        {{ $slot->isEmpty() ? 'Foi criado um registro temporário para o usuário! O link de registro foi copiado' : $slot }}
    </div>

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
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $employee->name }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ \App\Helpers\FormatHelper::formatCpf($employee->cpf) }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div
                                class="{{ $employee->status ? 'bg-green-100' : ($employee->email ? 'bg-red-100' : 'bg-yellow-100') }} inline-block p-1 rounded-md">
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
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('employee.show', $employee->name) }}"
                                class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-eye"></i> <!-- Ícone de 'olho' do Font Awesome -->
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($employees->isEmpty())
            <div class="px-5 py-5 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                    Nenhum registro encontrado.
                </p>
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('addEmployeeForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let form = this;
        let formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    displayErrors(data.errors);
                } else {
                    hideModal()
                    showActionMessage()
                    copyTextToClipboard(data.link)
                }
            })
            .catch(error => console.error('Error:', error));
    });

    function displayErrors(errors) {
        let errorsContainer = document.getElementById('formErrors');
        errorsContainer.innerHTML = '';
        Object.keys(errors).forEach(function(key) {
            errorsContainer.innerHTML += '<p>' + errors[key][0] + '</p>';
        });
    }

    function showModal() {
        document.getElementById('addEmployeeModal').style.display = 'block';
    }

    function hideModal() {
        document.getElementById('addEmployeeModal').style.display = 'none';
    }

    function showActionMessage() {
        var message = document.getElementById('actionMessage');
        message.style.display = 'block';
        setTimeout(function() {
            message.style.display = 'none';
        }, 6000);
    }
</script>
