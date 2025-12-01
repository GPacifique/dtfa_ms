<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Student $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function build(): self
    {
        $student = $this->student;

        return $this
            ->subject('Welcome to DTFA — Registration Confirmed')
            ->markdown('emails.students.registered', [
                'student' => $student,
                'parent' => $student->parent,
            ]);
    }
}
