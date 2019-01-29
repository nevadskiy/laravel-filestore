<?php

namespace App\Mail\Files;

use App\File;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileUpdatesApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var File
     */
    public $file;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
        $this->user = $file->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your file updated have been approved')
            ->view('emails.files.updates.approved');
    }
}
