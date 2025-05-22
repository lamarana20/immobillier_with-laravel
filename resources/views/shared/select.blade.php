@php
    $class ??= null;
    $name ??= '';
    $value ??= [];
    $label ??= ucfirst($name);
    $multiple ??= false;
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label }}</label>
    <select 
        name="{{ $multiple ? $name . '[]' : $name }}" 
        id="{{ $name }}" 
        {{ $multiple ? 'multiple' : '' }} 
        class="form-select @error($name) is-invalid @enderror"
    >
        @foreach ($options as $k => $v)
            <option 
                value="{{ $k }}" 
                @selected(in_array($k, (array) old($name, $value)))
            >
                {{ $v }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
