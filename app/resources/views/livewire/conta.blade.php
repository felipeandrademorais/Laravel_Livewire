<div class="col-md-12">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Número da conta</th>
                <th scope="col">Editar</th>
                <th scope="col">Remover</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contas as $conta)
                <tr>
                    <th>{{ $conta->pessoa->nome }}</th>
                    <td>{{ $conta->pessoa->cpf }}</td>
                    <td>{{ $conta->conta }}</td>
                    <td>
                        <a href="{{ route('cadastro.conta', ['id' => $conta->id]) }}" type="button" class="btn btn-primary">
                            Editar
                        </a>
                    </td>
                    <td>
                        <button 
                            onclick="confirm('Deseja realmente excluir?') || event.stopImmediatePropagation()" 
                            wire:click="delete({{ $conta->id }})" 
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
    <a href="{{ route('cadastro.conta') }}" class="btn btn-primary">
        Nova Conta
    </a>
</div>
