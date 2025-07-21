@props(['name', 'class' => 'alert alert-danger'])

@php
$isSuccess = $name === 'status';

$finalClass = $isSuccess ? 'alert alert-success' : $class;
$iconClass = $isSuccess ? 'fas fa-check-circle' : 'fas fa-times-circle';
@endphp

@error($name)
<div class="{{ $finalClass }}">
    <i class="{{ $iconClass }} me-2"></i>
    <strong>{{ $message }}</strong>
</div>
@enderror