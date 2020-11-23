<?php

namespace App\Http\Middleware;

use App\Models\Submission;
use Closure;
use Illuminate\Support\Facades\Auth;

class CanSubmissionBeEdited
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        
		if ($request->route('submissionId')) {

			$submission = Submission::where(
				[
					['id', $request->route('submissionId')],
					['userid', Auth::user()->id],
				]
			)->first();

			if ($submission != null) {

				if ($submission->status->name == 'rejected') {
					return	redirect()->route('author')->with([
						'danger' => '<strong>Your Submission was rejected by the editor.</strong> Your submission did not meet our standards.'
					]);
				}

				if ($submission->status->name == 'review in progress') {
					return	redirect()->route('author')->with([
						'warning' => '<strong>Your Submission is being reviewed.</strong> So submission information cannot be edited. You will be notified once review process on finished.'
					]);
				}

				if ($submission->status->name == 'accepted') {
					return	redirect()->route('author')->with([
						'warning' => '<strong>Congrats!</strong> Your Submission was accepted.'
					]);
				}

				return $next($request);
			}
		}

		return	redirect()->route('author')->with([
			'warning' => '<strong>Submission does not exists.</strong>'
		]);
	}
}
