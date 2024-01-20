<div>
    <div class="form-row">

        <div class="col-md-2">
            <div class="form-group">
                <label for="ciudad_id">CIUDAD:</label>
                <select wire:model="selectedCiudad"
                    class="form-control select2 @error('ciudad_id') is-invalid @enderror" style="width: 100%" required>
                    <option value="" disabled selected>Seleccione una Ciudad:
                    </option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->detciudad }}</option>
                    @endforeach
                </select>
                @error('ciudad_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if (!is_null($estandares))
                <div class="form-group">
                    <label for="estandar_id">Estandar</label>
                    <select wire:model="selectedEstandar" class="form-control select2" style="width: 100%" required>
                        <option value="" disabled selected>Seleccione un Estandar:</option>
                        @foreach ($estandares as $estandar)
                            <option value="{{ $estandar->id }}">{{ $estandar->detestandar }}</option>
                        @endforeach
                    </select>
                    @error('estandar_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif
            @if (!is_null($fuentes))
                <div class="form-group">
                    <label for="tipoemisora_id">Tipo de Emisora</label>
                    <select wire:model="selectedTipoemisora" class="form-control select2" style="width: 100%">
                        <option value="" disabled selected>Seleccione el Tipo de Emisora:</option>
                        @foreach ($fuentes as $fuente)
                            <option value="{{ $fuente->id }}">{{ $fuente->detfuente }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            {{-- @if (!is_null($emisor)) --}}
            <div class="form-group">
                <label for="emisora_id">Emisora</label>
                <select wire:model="selectedEmisora" class="form-control select2" style="width: 100%" required>
                    <option value="" disabled selected>Seleccione la Emisora:</option>
                    {{-- @foreach ($emisoras as $emisora)
                            <option value="{{ $emisora->id }}">{{ $emisora->emisora }}</option>
                        @endforeach --}}
                </select>
            </div>
            {{-- @endif --}}
            <div class="form-group">
                <input type="submit" value="Mostrar" class="btn btn-primary" style="width: 100%;">

                <a href="{{ URL::previous() }}" class="btn btn-secondary" style="width: 100%;">Cancelar</a>
            </div>
        </div>
        <div class="form-row float-right col-md-10 px-md-2" style="height: 700px; width: 100%;">
            <iframe style="width: 100%;" id="simulacionIframe" frameborder="0"></iframe>
        </div>
    </div>
</div>
