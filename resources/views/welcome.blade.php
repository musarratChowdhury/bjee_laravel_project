@extends('layouts.new')

@section('content')

<div id="sj-twocolumns" class="sj-twocolumns">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-8 col-lg-9">
				<div id="sj-content" class="sj-content">
					<!--************************************
						Editor's Pick Start
				*************************************-->
					<section class="sj-haslayout sj-sectioninnerspace">
						<div class="sj-borderheading">
							<h3>Latest Articles</h3>
							<a class="sj-btnview" href="javascript:void(0);">View All</a>
						</div>

						<div id="sj-editorchoiceslider" class="sj-editorchoiceslider sj-editorschoice owl-carousel">
							<div class="item">
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
                                            <span class="sj-username1"><a href="{{ route('article-31-1')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-1')}}" target="_blank">Impact of ‘Foundation Training for University Teachers’ Conducted by Bangladesh Agricultural University</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M. M. Ali, B. Mawa</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-1')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
									    <div class="sj-head">
                                            <span class="sj-username1"><a href="{{ route('article-31-2')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-2')}}" target="_blank">The Impact of Climate Change in the Coastal Areas of Bangladesh Affected by Cyclone Bulbul</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.A. Haque, M.A. Alam, S.M. Moniruzzaman, M. M. Hoque</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-2')}}" target="_blank">View Full Article</a>
									</div>
								</article>

								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
                                            <span class="sj-username1"><a href="{{ route('article-31-3')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-3')}}" target="_blank">Constraints of Using Information and Communication Technologies by Young Entrepreneurs for Farm Management</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.S.U. Asif, M.G. Farouque, M. H. Rahman, M. M. Rana</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-3')}}" target="_blank">View Full Article</a>
									</div>
								</article>
							</div>

							<div class="item">
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
                                            <span class="sj-username1"><a href="{{ route('article-31-4')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-4')}}" target="_blank">Effectiveness and Constraints of ICT Enablers Used by the
                                                Farmers in Northern Bangladesh</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.F. Hasan, M.A. Sayem, S. Sarmin, A. Shahin</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-4')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
                                            <span class="sj-username1"><a href="{{ route('article-31-5')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-5')}}" target="_blank">Unfolding Household Typology towards Better Extension Advisory Services in Typical Southern Villages of Bangladesh</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.W. Rahman, M. Das</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-5')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-6')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-6')}}" target="_blank">Utilization of Aqua Drugs for Fish Health Management by the Fish Farmers: Field Level Analysis</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.Z. Haque, S. Sheheli, M.H. Rahman, M.N.A.S. Mithun</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-6')}}" target="_blank">View Full Article</a>
									</div>
								</article>
							</div>

							<div class="item">
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
											<span class="sj-username1"><a href="{{ route('article-31-7')}}" target="_blank">Research Article</a></span>
                                                <h3><a href="{{ route('article-31-7')}}" target="_blank">Factors Contributing to Farmers’ Attitude towards Practicing Aquaculture in Dinajpur District of Bangladesh</a></h3>
                                            </div>
                                            <div class="sj-description">
                                                <p>M.F. Hasan, M.F. Hossain, M.S. Rahman, S. Sarmin</p>
                                            </div>
                                            <a class="sj-btn" href="{{ route('article-31-7')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
											<span class="sj-username1"><a href="{{ route('article-31-8')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-8')}}" target="_blank">Effects of Fishing Practices on Fish Species Loss in Old Brahmaputra River</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M. Sultana, M. Z. Rahman, M. J. Hoque, M. S. Kowsari</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-8')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
											<span class="sj-username1"><a href="{{ route('article-31-9')}}" target="_blank">Research Article</a></span>
                                                <h3><a href="{{ route('article-31-9')}}" target="_blank">Farmers’ Knowledge of Climate Change in Northern Bangladesh</a></h3>
                                            </div>
                                            <div class="sj-description">
                                                <p>S. Sarmin, M.F. Hasan</p>
                                            </div>
                                            <a class="sj-btn" href="{{ route('article-31-9')}}" target="_blank">View Full Article</a>
									</div>
								</article>
							</div>

							<div class="item">
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-10')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-10')}}" target="_blank">Influence of Social Networks on Information Acquisition and Adoption of Soil Fertility Management Technologies</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.G. Farouque, D. Roy, K.H. Kabir</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-10')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-11')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-11')}}" target="_blank">Smallholder Farmers’ Use of Recommended Technologies in Broiler Production</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.H. Rahman, M.M.R. Sarkar, M.S. Kowsari</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-11')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-12')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-12')}}" target="_blank">Assessment of People’s Personal Profile Contribution towards Participation in Flood Coping Mechanism</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M.Y. Uddin, M.N. Islam, M.R.A.F. Noman, S. Huda</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-12')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
							</div>
							
							<div class="item">
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-13')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-13')}}" target="_blank">Competencies of Sub Assistant Agriculture Officers of DAE in Dinajpur District</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>A. Shahin, M.F. Hasan, S. Huda</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-13')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-14')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-14')}}" target="_blank">Food Waste Behavior of Rural Women</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>M. T. Hossain, M. Z. Rahman, M. H. Rahman</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-14')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-15')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-15')}}" target="_blank">Participatory Pond Fish Production as an Income Generating Activity:
                                                A farm level study</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>S. Sheheli, M.S. Kowsari, M.N.A.S. Mithun</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-15')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
							</div>
							
							<div class="item">
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-16')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-16')}}" target="_blank">Attitude of Farmers towards Television Programmes in Perceiving
                                                Agricultural Information</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>F.H. Choudhury, M.R. Amin, M.A. Islam, S.D. Baishakhy</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-16')}}" target="_blank">View Full Article</a>
									</div>
								</article>
								
								<article class="sj-post sj-editorchoice">
									<figure class="sj-postimg">
										<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
									</figure>
									<div class="sj-postcontent">
										<div class="sj-head">
										    <span class="sj-username1"><a href="{{ route('article-31-17')}}" target="_blank">Research Article</a></span>
                                            <h3><a href="{{ route('article-31-17')}}" target="_blank">Assessing Empowerment Status of Women Tea Garden Workers: A Case of
                                                Doldoli Tea Garden, Sylhet</a></h3>
                                        </div>
                                        <div class="sj-description">
                                            <p>K. Fatema, M.A. Sarker, M.A. Islam, M.M. Rana</p>
                                        </div>
                                        <a class="sj-btn" href="{{ route('article-31-17')}}" target="_blank">View Full Article</a>
                    									</div>
								</article>
								

								
							</div>
						</div>
					</section>
					<!--************************************
						Editor's Pick End
				*************************************-->
				</div>
			</div>

			@include('templates-parts.sidebar')
		</div>
	</div>
</div>
@endsection

@section('homebanner')
<div id="sj-homebanner" class="sj-homebanner">
	<div class="container">
		<div class="row">

			<div class="col-12 col-sm-12 col-md-3 col-lg-3">
				<nav class="sj-bannersidebar">
					<ul>
						<li class="active"><a href="{{ url('/') }}">Home</a></li>
						<li><a href="{{ url('/about') }}">About</a></li>
						<li><a href="{{ url('/editorial-board') }}">Editorial Board</a></li>
						<li><a href="{{ url('/instructions-to-authors') }}">Author Guideline</a></li>
						<li><a href="{{ url('/author/start-submission') }}">Submit Article</a></li>
						<li><a href="{{ url('/archive') }}">Journal Archive</a></li>
						<li><a href="http://baes.com.bd/" target="_blank">BAES (Society Page)</a></li>
						<li><a href="{{ url('/contacts') }}">Contacts</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-12 col-sm-12 col-md-5 col-lg-5">
				<div class="sj-bannercontent">
					<h1><span>Welcome to the</span>Bangladesh Journal<span>of Extension Education</span></h1>
					<div class="sj-description">
						<p>Bangladesh Journal of Extension Education (BJEE) is an international scientific journal publication of the Bangladesh Agricultural Extension Society (BAES). ... <a href="{{ url('/about') }}">Read more</a></p>
					</div>
				</div>

			</div>
			<div class="col-12 col-sm-12 col-md-4 col-lg-4">
				<div class="sj-postbook">
					<figure class="sj-featureimg">
						<a class="sj-btnvideo" href="javascript:void(0);" style="display: none;"><i class="lnr lnr-film-play"></i><span>Watch Video Documentary</span></a>
						<div class="sj-bookimg">
							<div class="sj-frontcover"><img src="{{ asset('theme/images/journal-cover-photo.jpg') }}" alt="image description"></div>
						</div>
					</figure>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content1')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			@guest
			<div class="card">
				<div class="card-header">Journal Project</div>

				<div class="card-body">
					<a href="{{ route('login') }}"> Log In Now!</a>
				</div>
			</div>
			@else
			<div class="card">
				<div class="card-header">Journal Project</div>
				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					Hi {{ Auth::user()->name }}; you are logged in as @foreach (Auth::user()->getRoleNames() as $role)
					{{ $role }}
					@endforeach
				</div>
			</div>
			@endguest
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('theme/js/owl.carousel.min.js') }}"></script>
@endsection