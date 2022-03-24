<div id="field_provincia_id" class="{{ $extraClass ?? 'col-lg-12' }}">
    <div class="mb-3 tal">
        <label for="provincia_id">
            {{ $label ?? __('components.province') }}
        </label>
        <select id="provincia_id" name="provincia_id" ref="provincia_id" class="form-select" v-model="publicacion.provincia_id">
            @foreach($provincias as $key => $provincia)
                <option value="{{ $key }}" {{ ($provincia_id == $key) ? 'selected' : '' }}>{{ $provincia }}</option>
            @endforeach
        </select>
    </div>
</div>

