<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyReviewer extends Mailable
{
	use SerializesModels;

	protected $reviewerName;
	protected $submissionTitle;
	protected $expireDate;
	protected $reviewerId;
	protected $email;
	protected $viewPassword;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(
		$reviewerName,
		$submissionTitle,
		$submissionId,
		$expireDate,
		$reviewerId,
		$email,
		$viewPassword
	) {
		$this->reviewerName = $reviewerName;
		$this->submissionTitle = $submissionTitle;
		$this->submissionId = $submissionId;
		$this->expireDate = $expireDate;
		$this->reviewerId = $reviewerId;
		$this->email = $email;
		$this->viewPassword = $viewPassword;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->markdown('mails.NotifyReviewer')->with([
			'reviewerName' => $this->reviewerName,
			'submissionTitle' => $this->submissionTitle,
			'submissionId' => $this->submissionId,
			'expireDate' => $this->expireDate,
			'reviewerId' => $this->reviewerId,
			'email'=> $this->email,
			'viewPassword'=> $this->viewPassword
		]);
	}
}
