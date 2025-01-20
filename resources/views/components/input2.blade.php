<div class="mb-3 row">
    <label for="{{ $nombre }}" class="col-4 col-form-label">{{ $nombre }}:</label>
    <div class="col-8">
        <textarea 
            class="form-control form-control-lg bg-light" 
            name="{{ $campo }}" 
            id="{{ $nombre }}" 
            style="height: auto; min-height: 100px; overflow-y: auto;" 
            placeholder="{{ $holder }}">{{ old($campo, $valorcampo) }}</textarea>

        <div class="error">
            @error($campo)
                <span style="color: brown;">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
