<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\StudentRegistered;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;

class StudentRegistrationController extends Controller
{
    public function send(Student $student)
    {
        $recipient = $student->email ?: optional($student->parent)->email;
        if (!$recipient) {
            return back()->with('error', 'No recipient email found for this student.');
        }

        Mail::to($recipient)->queue(new StudentRegistered($student));

        return back()->with('status', 'Registration confirmation email queued successfully.');
    }
}
