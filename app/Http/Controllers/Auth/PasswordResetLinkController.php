<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
        } catch (TransportExceptionInterface $e) {
            // Log the error for admin review
            Log::error('Email sending failed: ' . $e->getMessage(), [
                'email' => $request->email,
                'error_code' => $e->getCode(),
            ]);

            // Check if it's a Gmail sending limit error
            if (str_contains($e->getMessage(), 'Daily user sending limit exceeded') ||
                str_contains($e->getMessage(), '550-5.4.5')) {
                return back()->withInput($request->only('email'))
                    ->withErrors(['email' => 'Our email service is temporarily unavailable due to high demand. Please try again in a few hours or contact support at support@sportacademyms.com for assistance.']);
            }

            // Generic email error message
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'We are unable to send the password reset email at this time. Please try again later or contact support for assistance.']);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Unexpected error during password reset: ' . $e->getMessage(), [
                'email' => $request->email,
                'exception' => get_class($e),
            ]);

            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'An unexpected error occurred. Please try again later or contact support.']);
        }
    }
}
