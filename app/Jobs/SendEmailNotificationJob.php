<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\SentMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmailNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $email;
    private $subject;
    private $body;
    private $data;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $subject, $body, $data)
    {
        $this->email    = $email;
        $this->subject  = $subject;
        $this->body     = $body;
        $this->data     = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $mail = $this->sendEmail();
            Log::info("Send email successfully", ["data"=>$mail->getSymfonySentMessage()->toString()]);
        } catch (\Throwable $th) {
            Log::error("Send email failed", ["th" => $th->getMessage()]);
        }
    }

    public function sendEmail(): SentMessage
    {
        $email      = $this->email;
        $subject    = $this->subject;
        $body       = $this->body;
        $data       = $this->data;

        $mail = Mail::send([], $data, function ($message) use ($email, $subject, $body) {
            $message->to($email)
                    ->subject($subject)
                    ->html($body);
        });

        return $mail;
    }
}
