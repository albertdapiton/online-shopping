<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        if (! $request->hasValidSignature()) {
            return response()->json([
                'message' => 'Invalid Signature' //trans('verify.invalid_signature')
            ], 401);
        }
    }

    public function resend(EmailVerificationRequest $request)
    {

    }
}
