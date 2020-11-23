
@component('mail::message')
# Review Request
Dear {{ $reviewerName ?? '' }}

I would like to request you to kindly review the following manuscript, entitled "<strong>Title {{ $submissionTitle ?? ' - ' }}</strong>" has been submitted to the Bangladesh Journal of Extension Education. 

Please let me know as soon as possible if you will be able to accept my invitation to review.  To do this please either click the appropriate link below to automatically register your reply with our online manuscript submission and review system, or e-mail me with your reply. 

Agree: <a target="_blank" href="{{route('reviewer.acceptedToReview' , ['reviewerId' => $reviewerId, 'submissionId' => $submissionId])}}">{{route('reviewer.acceptedToReview' ,['reviewerId' => $reviewerId, 'submissionId' => $submissionId])}}</a>

Decline: <a target="_blank" href="{{route('reviewer.declineToReview' , ['reviewerId' => $reviewerId, 'submissionId' => $submissionId])}}">{{route('reviewer.declineToReview' , ['reviewerId' => $reviewerId, 'submissionId' => $submissionId])}}</a>


Login Credentials are:<br>
Email : {{ $email }}
Password: {{ $viewPassword }}


Should you accept my invitation to review this manuscript, click on the “agree” option which will automatically direct you to the manuscript and reviewer instructions in your Reviewer Centre. 

If you are unable to review the manuscript, click on the “decline” option to register your response. 

I will be grateful if you please act as a reviewer of this manuscript. I thank you for your present and/or future participation. 

Sincerely,

Professor Dr. Md. Golam Farouque
Editor
Bangladesh Journal of Extension Education (BJEE)

@endcomponent