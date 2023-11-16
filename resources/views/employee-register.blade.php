<x-clean-layout>
    <div class="bg-indigo-50 flex flex-col items-center w-screen ml-[calc(50%_-_50vw)] h-screen px-5">
        <div class="items-stretch flex w-[189px] max-w-full gap-2 ml-auto mt-8 border-b-stone-900 border-b border-solid">
            <img loading="lazy" srcset="..."
                class="aspect-square object-contain object-center w-6 overflow-hidden shrink-0 max-w-full" />
        </div>
        <div class="bg-white mt-44 mb-36 pl-44 pr-16 py-12 rounded-2xl max-md:max-w-full">
            <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                <div class="flex flex-col items-stretch w-2/5 max-md:w-full max-md:ml-0">
                    <div class="flex flex-col items-center my-auto max-md:mt-10">
                        <img loading="lazy"
                            src="https://cdn.builder.io/api/v1/image/assets/TEMP/21bff162-28f2-415f-893e-fa601749f82c?"
                            class="aspect-[2.17] object-contain object-center w-[265px] justify-center items-center overflow-hidden max-w-full" />
                        <div
                            class="text-neutral-800 text-center text-2xl font-medium leading-7 self-stretch whitespace-nowrap mt-5">
                            Seja bem-vindo ao nosso time!
                        </div>
                        <div class="text-neutral-800 text-center text-base leading-5 self-stretch mt-3">
                            Preencha as informações necessárias para garantir um controle
                            eficaz do seu expediente.
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-stretch w-3/5 ml-5 max-md:w-full max-md:ml-0">
                    <div
                        class="flex items-stretch justify-start gap-5 mt-1.5 max-md:max-w-full max-md:flex-wrap max-md:mt-10">
                        <div class="bg-black w-px shrink-0 h-[612px]"></div>

                        <form action="{{ route('employee.update', $employee->id) }}" method="POST"
                            id="registerEmployeeForm"
                            class="self-center flex grow basis-[0%] flex-col my-auto max-md:max-w-full">
                            @csrf
                            <div
                                class="text-neutral-800 text-2xl font-medium leading-7 uppercase self-stretch whitespace-nowrap max-md:max-w-full">
                                Registro de ponto eletrônico
                            </div>
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 mt-10">
                                <div class="md:col-span-5">
                                    <label for="name">Nome completo</label>
                                    <input type="text" name="name" id="name"
                                        class="h-10 border mt-1 px-4 w-full bg-gray-50" value="{{ $employee->name }}"
                                        required disabled />
                                    <div class="bg-zinc-700 self-stretch shrink-0 h-px max-md:max-w-full"></div>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="h-10 border mt-1 px-4 w-full bg-gray-50" value="" required
                                        placeholder="email@domain.com" />
                                    <div class="bg-zinc-700 self-stretch shrink-0 h-px max-md:max-w-full"></div>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="cpf">CPF</label>
                                    <input type="text" name="cpf" id="cpf"
                                        class="h-10 border mt-1 px-4 w-full bg-gray-50" value="{{ $employee->cpf }}"
                                        placeholder="Seu CPF (Sem pontos ou traços)" required disabled />
                                    <div class="bg-zinc-700 self-stretch shrink-0 h-px max-md:max-w-full"></div>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="phone">Telefone</label>
                                    <input type="tel" name="phone" id="phone"
                                        class="h-10 border mt-1 px-4 w-full bg-gray-50" value=""
                                        placeholder="Seu telefone sem espaços ou caracteres especiais" />
                                    <div class="bg-zinc-700 self-stretch shrink-0 h-px max-md:max-w-full"></div>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="knowledges">Conhecimentos</label>
                                    <select name="knowledges[]" id="knowledges"
                                        class="h-30 border mt-1 px-4 w-full bg-gray-50" multiple required>
                                        <option value="Git">Git</option>
                                        <option value="React">React</option>
                                        <option value="PHP">PHP</option>
                                        <option value="NodeJS">NodeJS</option>
                                        <option value="DevOps">DevOps</option>
                                        <option value="Database">Banco de Dados</option>
                                        <option value="TypeScript">TypeScript</option>
                                    </select>
                                    <div class="bg-zinc-700 self-stretch shrink-0 h-px max-md:max-w-full"></div>
                                </div>

                            </div>

                            <div class="text-red-600 mt-1" id="formErrors"></div>

                            <div class="self-center flex w-[265px] max-w-full items-stretch gap-4 mt-5 max-md:mt-5">
                                <div
                                    class="justify-center items-stretch shadow bg-neutral-100 flex grow basis-[0%] flex-col rounded-lg">
                                    <button
                                        class="text-neutral-800 text-center text-sm font-medium leading-5 tracking-normal whitespace-nowrap justify-center items-center bg-white bg-opacity-10 px-5 py-2.5"
                                        type="reset">
                                        CANCELAR
                                    </button>
                                </div>
                                <div
                                    class="justify-center items-stretch shadow bg-indigo-700 flex grow basis-[0%] flex-col rounded-lg">
                                    <button
                                        class="text-white text-center text-sm font-medium leading-5 tracking-normal whitespace-nowrap justify-center items-center bg-white bg-opacity-10 px-5 py-2.5"
                                        type="submit">
                                        CONFIRMAR
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-clean-layout>

<script>
    document.getElementById('registerEmployeeForm').addEventListener('submit', function(event) {
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
                    alert('Registro realizado com sucesso!')
                    window.close()
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

    document.getElementById('knowledges').addEventListener('change', function() {
        var options = this.options;
        var count = 0;
        for (var i = 0; i < options.length; i++) {
            if (options[i].selected) count++;
        }
        if (count > 3) {
            alert('Você pode selecionar no máximo 3 conhecimentos.');
            for (var i = options.length - 1; i >= 0; i--) {
                if (options[i].selected) {
                    options[i].selected = false;
                    break;
                }
            }
        }
    });
</script>
