<div id="field_localidad_id" class="{{ $extraClass ?? 'col-lg-12' }}">
    <div class="mb-3 tal">
        <label for="localidad_id">
            {{ $label ?? __('components.locality') }}
        </label>
        <select id="localidad_id" name="localidad_id" ref="localidad_id" class="form-select" v-model="publicacion.localidad_id">
        </select>
    </div>
</div>

