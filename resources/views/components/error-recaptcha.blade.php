@if ($errors->has('captcha'))
<div class="text-danger mt-1">
    <strong style="font-size: 14px;">
        {{ $errors->first('captcha') }}
    </strong>
</div>
@elseif ($errors->has('g-recaptcha-response'))
<div class="text-danger mt-1">
    <strong style="font-size: 14px;">
        {{ $errors->first('g-recaptcha-response') }}
    </strong>
</div>
@endif