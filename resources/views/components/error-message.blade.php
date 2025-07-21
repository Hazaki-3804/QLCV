@props(['name', 'class' => 'text-danger mt-1'])

@error($name)
<div class="{{ $class }}">
    <strong style="font-size: 14px;">{{ $message }}</strong>
</div>
@enderror