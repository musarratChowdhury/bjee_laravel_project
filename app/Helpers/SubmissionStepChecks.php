<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class SubmissionStepChecks extends Model
{
	public static function message($submission, $stepsToCheck = [1, 2, 3, 4, 5])
	{
		$msg = [];

		if (in_array(1, $stepsToCheck)) {
			if ($submission->title == null) {
				$msg['Step 1: Manuscript Data'][] = 'Title is missing';
			}
			if ($submission->type == null) {
				$msg['Step 1: Manuscript Data'][] = 'Type is missing';
			}
			if ($submission->running_head == null) {
				$msg['Step 1: Manuscript Data'][] = 'Running head is missing';
			}
			if ($submission->abstract == null) {
				$msg['Step 1: Manuscript Data'][] = 'Abstract text is missing';
			}
			if($submission->number_of_words === null){
			    $msg['Step 1: Manuscript Data'][] = 'Number of Words is a required field';
			}
			if ($submission->special_issue === null) {
				$msg['Step 1: Manuscript Data'][] = 'Special Issue is a required field';
			}
		}

		if (in_array(2, $stepsToCheck)) {
			if ($submission->file == null) {
				$msg['Step 3: File Upload'][] = 'Files not uploaded';
			}
		}

		if (in_array(3, $stepsToCheck)) {
			if (\App\Models\SubmissionKeyword::where('submission_id', $submission->id)->count() == 0) {
				$msg['Step 2: Keywords'][] = 'No Keywords added';
			}
		}

		if (in_array(4, $stepsToCheck)) {
		}

		if (in_array(5, $stepsToCheck)) {
			
			// if ($submission->number_of_figures == null) {
			// 	$msg['Step 5: Details & Comments'][] = 'Number of Figures  is required.';
			// }

			// if ($submission->number_of_color_figures == null) {
			// 	$msg['Step 5: Details & Comments'][] = 'Number of Color Figures is required.';
			// }

			// if ($submission->number_of_tables == null) {
			// 	$msg['Step 5: Details & Comments'][] = 'Number of Tables is required.';
			// }

// 			if ($submission->number_of_words == null) {
// 				$msg['Step 5: Additional Information'][] = 'Number of Words is required.';
// 			}

			if ($submission->cover_letter == null) {
				$msg['Step 5: Additional Information'][] = 'Cover letter is required.';
			}

			if ($submission->funding === null) {
				$msg['Step 5:  Additional Information'][] = 'Funding field is required.';
			}

			// if ($submission->color_reproduction === null) {
			// 	$msg['Step 5: Details & Comments'][] = 'Color Reproduction field is required.';
			// }

			// if ($submission->data_set_associated === null) {
			// 	$msg['Step 5: Details & Comments'][] = 'Data Policy field is required.';

			// 	if ($submission->data_set_associated === 1 && $submission->data_set_associated_yes === null) {
			// 		$msg['Step 5: Details & Comments'][] = 'As you answered yes, please State Dataset is a required field.';
			// 	}

			// }

			if ($submission->confirm_recommendation == null) {
				$msg['Step 5: Additional Information'][] = 'Accepted Manuscript Disclaimer is required.';
			}

			if ($submission->conflict_of_interest === null) {
				$msg['Step 5: Additional Information'][] = 'Conflict of Interest is required.';

			// 	if ($submission->conflict_of_interest === 1 && $submission->conflict_of_interest_yes == null) {
			// 		$msg['Step 5: Details & Comments'][] = 'As you answered yes, Please State Conflict of Interest(s)';
			// 	}

			// }

			if ($submission->manuscript_previously === null) {
				$msg['Step 5: Additional Information'][] = 'Has this manuscript been submitted previously? is required.';
			}

			// if ($submission->human_subjects === null) {
			// 	$msg['Step 5: Details & Comments'][] = 'Human Subjects Approval is required.';

			// 	if ($submission->human_subjects === 'c' && $submission->human_subjects_details_c === null) {
			// 		$msg['Step 5: Details & Comments'][] = 'You answered C above, please detail how you protected your study participants is a required field.';
			// 	}

			// 	if ($submission->human_subjects_details_d === 'c' && $submission->human_subjects_details_d === null) {
			// 		$msg['Step 5: Details & Comments'][] = 'You answered D above, please detail how you protected your study participants is a required field.';
			// 	}

			// }
		}

		return $msg;
	}
	}

	public static function validate($submission, $stepsToValidate = [1, 2, 3, 4, 5])
	{
		if (in_array(1, $stepsToValidate)) {
			// code
		}
		if (in_array(2, $stepsToValidate)) {
			// code
		}
		if (in_array(3, $stepsToValidate)) {
			// code
		}
		if (in_array(4, $stepsToValidate)) {
			// code
		}
		if (in_array(5, $stepsToValidate)) {
			// code
		}
		if (in_array(6, $stepsToValidate)) {
			// code
		}
	}
}
