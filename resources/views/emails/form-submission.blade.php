<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            background-color: rgba(255,255,255,0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .content {
            padding: 30px;
        }
        .info-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #667eea;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .info-section h4 {
            margin: 0 0 8px 0;
            color: #667eea;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 600;
        }
        .info-section p {
            margin: 0;
            font-size: 14px;
        }
        .form-content {
            margin-bottom: 20px;
        }
        .form-content h3 {
            margin: 0 0 15px 0;
            font-size: 18px;
            color: #333;
            font-weight: 600;
        }
        .message-body {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 14px;
            line-height: 1.6;
        }
        .form-fields {
            margin: 20px 0;
        }
        .form-field {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .form-field:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .field-label {
            font-weight: 600;
            color: #667eea;
            font-size: 13px;
            margin-bottom: 5px;
            text-transform: capitalize;
        }
        .field-value {
            font-size: 14px;
            color: #333;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #666;
        }
        .action-button {
            display: inline-block;
            background-color: #667eea;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin-top: 15px;
            text-align: center;
        }
        .action-button:hover {
            background-color: #764ba2;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
            }
            .content {
                padding: 20px;
            }
            .header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Form Submission</h2>
            <span class="badge">{{ $formSubmission->getFormTypeLabel() }}</span>
        </div>

        <div class="content">
            @if ($recipientType === 'staff')
                <div class="info-section">
                    <h4>📧 Submitted By</h4>
                    <p>
                        @if ($formSubmission->submitter)
                            <strong>{{ $formSubmission->submitter->name }}</strong><br>
                            {{ $formSubmission->submitter->email }}
                        @else
                            Anonymous User
                        @endif
                    </p>
                </div>

                <div class="info-section">
                    <h4>⏰ Submission Time</h4>
                    <p>{{ $formSubmission->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>

                <div class="info-section">
                    <h4>📝 Form Type</h4>
                    <p>{{ $formSubmission->getFormTypeLabel() }}</p>
                </div>
            @else
                <div class="info-section">
                    <h4>✓ Thank You</h4>
                    <p>We have received your {{ strtolower($formSubmission->getFormTypeLabel()) }}. Our team will review it shortly.</p>
                </div>
            @endif

            @if ($formSubmission->subject)
                <div class="form-content">
                    <h3>Subject</h3>
                    <p style="margin: 0; font-size: 15px; color: #333;">{{ $formSubmission->subject }}</p>
                </div>
            @endif

            <div class="form-content">
                <h3>Message</h3>
                <div class="message-body">{{ $formSubmission->message }}</div>
            </div>

            @if ($formSubmission->form_data && is_array($formSubmission->form_data) && count($formSubmission->form_data) > 0)
                <div class="form-fields">
                    <h3 style="margin: 0 0 15px 0;">Additional Information</h3>
                    @foreach ($formSubmission->form_data as $key => $value)
                        <div class="form-field">
                            <div class="field-label">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                            <div class="field-value">
                                @if (is_array($value))
                                    {{ implode(', ', $value) }}
                                @else
                                    {{ $value }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($recipientType === 'staff')
                <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #e0e0e0;">
                    <p style="margin: 0 0 15px 0; font-size: 14px;"><strong>Action Required:</strong></p>
                    <p style="margin: 0; font-size: 13px; color: #666;">Please log in to the system to respond to this submission.</p>
                </div>
            @endif
        </div>

        <div class="footer">
            <p style="margin: 0;">This is an automated email from {{ config('app.name', 'SAMS') }} Form Submission System</p>
            <p style="margin: 5px 0 0 0; color: #999;">{{ $formSubmission->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
