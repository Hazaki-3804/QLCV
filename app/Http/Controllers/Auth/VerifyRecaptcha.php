<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait VerifyRecaptcha
{
    /**
     * Verify the reCAPTCHA response with Google.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function verifyRecaptcha(Request $request): bool
    {
        try {
            $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $recaptchaData = $recaptchaResponse->json();

            // Log reCAPTCHA API response for debugging
            Log::channel('login')->debug('reCAPTCHA API response.', [
                'data' => $recaptchaData,
                'email' => $request->input('email'),
                'ip' => $request->ip(),
            ]);

            return $recaptchaData['success'] ?? false;
        } catch (\Throwable $th) {
            // Log any errors during reCAPTCHA API call
            Log::channel('login')->error('Error calling reCAPTCHA API.', [
                'error' => $th->getMessage(),
                'email' => $request->input('email'),
                'ip' => $request->ip(),
            ]);
            return false;
        }
    }
}
