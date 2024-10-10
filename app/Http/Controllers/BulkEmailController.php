<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmailMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BulkEmailController extends Controller
{
    public function uploadBulkEmail(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'email_csv' => 'required|mimes:csv,txt|max:2048', // Only allow CSV or TXT file types
        ]);

        // Handle the file upload
        $file = $request->file('email_csv');
        $filePath = $file->getRealPath();

        // Open and read the CSV file
        $emails = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $emails[] = $data[0]; // Assuming the first column contains the email addresses
            }
            fclose($handle);
        }

        // Send emails to each address
        $subject = 'Bulk Email Subject';
        $body = 'This is the body of the bulk email.';

        foreach ($emails as $email) {
            $emailData = [
                'subject' => $subject,
                'body' => $body,
            ];

            // Send email using Mail facade
            Mail::to($email)->send(new BulkEmailMail($emailData));
        }

        // Return success message
        return back()->with('success', 'Bulk emails sent successfully!');
    }
}