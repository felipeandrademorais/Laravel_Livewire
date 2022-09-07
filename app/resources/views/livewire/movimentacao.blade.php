        
<div class="row d-flex justify-content-center">
    <div class="col-md-2">
        <form wire:submit.prevent="{{ $acao_botao }}">
            <div class="form-group">
                <label>Pessoa</label>
                <div wire:model="id_pessoa">
                    <select class="form-control" required>
                        <option value="">{{ __('Selecione') }}</option>
                        @forelse ($pessoas as $pessoa)
                            <option value="{{ $pessoa->id_pessoa }}"  {{ $pessoa->id_pessoa == $id_pessoa ? 'selected' : null }} wire:key="{{ $loop->index }}">
                                {{ $pessoa->nome . ' - '. $pessoa->cpf }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <span class="text-danger">@error('id_pessoa') {{ $message }} @enderror</span>
            </div>

            <div class="form-group">
                <label>Número da Conta</label>
                <div wire:model.defer="id_conta">
                    <select class="form-control" required>
                        <option value="" selected>{{ __('Selecione') }}</option>
                        @forelse ($contas as $conta)
                            <option value="{{ $conta->id }}" wire:key="{{ $loop->index }}">
                                {{ $conta->conta . '  - Saldo: ' .  $saldo }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <span class="text-danger">@error('id_conta') {{ $message }} @enderror</span>
            </div>

            <div class="form-group">
                <label>Valor</label>
                <input  class="form-control" wire:model.defer="valor" type="text" id="valor">
                <span class="text-danger">@error('valor') {{ $message }} @enderror</span>
            </div> 

            <div class="form-group">
                <label>Depositar/Retirar</label>
                <div wire:model.defer="tipo">
                    <select class="form-control" required>
                        <option value="" selected>{{ __('Selecione') }}</option>
                        <option value="depositar">Depositar</option>
                        <option value="retirar">Retirar</option>
                    </select>
                </div>
                <span class="text-danger">@error('tipo') {{ $message }} @enderror</span>
            </div>
            <div>
                <button class="btn btn-primary mt-3">{{$botao}}</button>       
            </div>
        </form>
    </div>

    <div class="col-md-6">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Pessoa</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movimentacoes as $movimentacao)
                    <?php  
                        $retirar = ($movimentacao->tipo == 'retirar' ? true : false); 
                    ?>
                    <tr>
                        <th>{{ $movimentacao->nome }}</th>
                        <td>{{ $movimentacao->created_at }}</td>
                        <td class="{{ $retirar ? 'text-danger' : '' }}">{{ $movimentacao->valor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($saldo)
            <span>Saldo: {{$saldo}}</span>
        @else
            <span>Saldo: 0</span>
        @endif
    </div>
</div>
