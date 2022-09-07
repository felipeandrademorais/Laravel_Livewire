<div class="col-md-3">
    <form wire:submit.prevent="{{ $acao_botao }}">
            <div class="form-group">
                <label>Nome
                    <input  class="form-control" wire:model.defer="nome" type="text" id="nome" required>
                    @error('nome') {{ $message }} @enderror
                </label>
            </div>

            <div class="form-group">
                <label>CPF
                    <input  class="form-control" wire:model.defer="cpf" type="number"  id="cpf" required>
                    @error('cpf') {{ $message }} @enderror
                </label>
            </div> 
                
            <div class="form-group">
                <label>CEP
                    <input  class="form-control"wire:model="cep" type="text" id="cep" required>
                    @error('cep') {{ $message }} @enderror
                </label>
            </div>

            <div class="form-group">
                <label>Número
                    <input  class="form-control"wire:model.defer="numero" type="text" id="numero" required>
                    @error('numero') {{ $message }} @enderror
                </label>
            </div>

            <div class="form-group">
            
                <label>Logradouro
                    <input  class="form-control"wire:model.defer="logradouro" type="text" id="logradouro" required>
                    @error('logradouro') {{ $message }} @enderror
                </label>
            </div>

            <div class="form-group">
                <label>Bairro
                    <input  class="form-control"wire:model.defer="bairro" type="text" id="bairro" required>
                    @error('bairro') {{ $message }} @enderror
                </label>
            </div>

            <div class="form-group">
            
                <label>Estado
                    <input  class="form-control"wire:model.defer="estado" type="text" id="estado" required>
                    @error('estado') {{ $message }} @enderror
                </label>
            </div>

            <div class="form-group">
                <label>Município
                    <input  class="form-control"wire:model.defer="municipio" type="text" id="municipio" required>
                    @error('municipio') {{ $message }} @enderror
                </label>
            </div>
            
            <button class="btn btn-primary mt-3">{{$botao}}</button>   
    </form>
</div>



<script>
    document.addEventListener('livewire:load', function () {
        // applyMask('cpf',document.querySelector('#cpf'));
        applyMask('cep',document.querySelector('#cep'));
    });

    function applyMask(op, e) {
        var mask = {
            'cpf' : ['999.999.999-99', '999.999.999-99'],
            'cep' : ['99999-999', '99999-999'],
        }
        e.addEventListener('input', inputHandler.bind(undefined, mask[op], 30), false);
    }

    function inputHandler(masks, max, event) {
        var c = event.target;
        var v = c.value.replace(/\D/g, '');
        var m = c.value.length > max ? 1 : 0;
        VMasker(c).unMask();
        VMasker(c).maskPattern(masks[m]);
        c.value = VMasker.toPattern(v, masks[m]);
    }
</script>