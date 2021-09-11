<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

class VerificationController extends Controller
{
    public function verified()
    {
        dd('Verified');
    }

    public function verify(Request $request)
    {
        if (! $request->hasValidSignature())
            throw new InvalidSignatureException;

        $user = User::find($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification())))
            throw new AuthorizationException;
    
        if ($user->markEmailAsVerified())
            event(new Verified($user));
        
        return redirect(route('user.verified'))->with('verified', true);
    }
}
