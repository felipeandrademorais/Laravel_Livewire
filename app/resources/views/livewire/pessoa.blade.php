
<div class="col-mt-12">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Endereço</th>
                <th scope="col">Editar</th>
                <th scope="col">Remover</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pessoas as $pessoa)
                <tr>
                    <th>{{ $pessoa->nome }}</th>
                    <td>{{ $pessoa->cpf }}</td>
                    <td>{{ $pessoa->logradouro }}</td>
                    <td>
                        <a href="{{ route('cadastro.pessoa', ['id' => $pessoa->id]) }}" type="button" class="btn btn-primary">
                            Editar
                        </a>
                    </td>
                    <td>
                        <button 
                            onclick="confirm('Deseja realmente excluir?') || event.stopImmediatePropagation()" 
                            wire:click="delete({{ $pessoa->id }})" 
                            type="button" 
                            class="btn btn-outline-danger"
                        >
                            Excluir
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="col-md-12">
    <a href="{{ route('cadastro.pessoa') }}" class="btn btn-primary">
        Nova Pessoa
    </a>
</div>
