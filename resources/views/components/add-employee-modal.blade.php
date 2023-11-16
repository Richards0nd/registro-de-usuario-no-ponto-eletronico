<div class="fixed inset-0 z-10 overflow-y-auto" style="display: none;" id="addEmployeeModal">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="addEmployeeForm" method="POST" action="{{ route('employee.request.new') }}">
                <div class="bg-gray-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Registrar usuário
                            </h3>
                            <p>Preencha o CPF do usuário, com isso quando o usuário acessar o link de registro, iremos
                                validar se o CPF que ele preencher poderá se registrar</p>
                            <div class="text-red-600 mt-1" id="formErrors"></div>
                            <div class="mt-2">
                                @csrf
                                <div class="mt-4">
                                    <label for="name"
                                        class="block text-sm font-medium leading-5 text-gray-700">Nome:</label>
                                    <input type="text" id="name" name="name" required
                                        class="form-input mt-1 block w-full" maxlength="100" minlength="2">
                                </div>
                                <div class="mt-4">
                                    <label for="cpf"
                                        class="block text-sm font-medium leading-5 text-gray-700">CPF:</label>
                                    <input type="text" id="cpf" name="cpf" required
                                        class="form-input mt-1 block w-full" maxlength="11" minlength="11">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                            onclick="event.preventDefault">
                            Salvar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button onclick="hideModal()" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancelar
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
