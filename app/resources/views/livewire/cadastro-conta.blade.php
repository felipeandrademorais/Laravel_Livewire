<div class="col-md-3">
    <form wire:submit.prevent="{{ $acao_botao }}">
        <div class="form-group">
            <label>Pessoa</label>
                <div wire:model.defer="id_pessoa">
                    <select class="form-control" required>
                        <option value="">{{ __('Selecione') }}</option>
                        @forelse ($pessoas as $pessoa)
                            <option value="{{ $pessoa->id }}"  {{$pessoa->id == $id_pessoa ? 'selected' : null }} wire:key="{{ $loop->index }}">
                                {{ $pessoa->nome . ' - '. $pessoa->cpf }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                @error('id_pessoa') {{ $message }} @enderror
        </div>

        <div class="form-group">
            <label>Número da Conta</label>
            <input  class="form-control" wire:model.defer="conta" type="number" id="conta" required>
            @error('conta') {{ $message }} @enderror
        </div> 
        
        <button class="btn btn-primary mt-3">{{$botao}}</button>   
    </form>
</div>
