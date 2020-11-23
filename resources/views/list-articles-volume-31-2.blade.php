@extends('layouts.new')

@section('homebanner')

<!--************************************
                    Inner Banner Start
            *************************************-->
<div class="sj-innerbanner">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="sj-innerbannercontent">
          <h1> Volume 31, Number 1&2, 2019</h1>

          <ol class="sj-breadcrumb ">
            <li>
              <a href="javascript:void(0);">
                Home
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                Volume 31, Number 1&2, 2019
              </a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!--************************************
                    Inner Banner End
*************************************-->
@endsection

@section('content')
<div id="sj-twocolumns" class="sj-twocolumns">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-9">
        <div id="sj-content" class="sj-content sj-addarticleholdcontent">
          <div class="sj-dashboardboxtitle sj-titlewithform">
            <h2>Volume 31, Number 1&2, 2019</h2>
            <form class="sj-formtheme sj-formsearchvtwo">
              <div class="sj-sortupdown">
                <a href="javascript:void(0);"><i class="fa fa-sort-amount-up"></i></a>
              </div>
              <fieldset>
                <input type="search" name="search" class="form-control" placeholder="Search here">
                <button type="submit" class="sj-btnsearch"><i class="lnr lnr-magnifier"></i></button>
              </fieldset>
            </form>
          </div>
          <ul id="accordion" class="sj-articledetails sj-articledetailsvtwo">
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
          </ul>
          <nav class="sj-pagination">
            <ul>
              <li class="sj-prevpage"><a href="{{ url('list-articles-volume-31-1') }}"><i class="fa fa-angle-left"></i> Previous</a></li>
              <li class="sj-active"><a href="{{ url('list-articles-volume-31-1') }}">01</a></li>
              {{-- <li><a href="#">02</a></li>
              <li><a href="#">03</a></li>
              <li><a href="#">04</a></li>
              <li><a href="#">05</a></li> --}}
              <li class="sj-nextpage"><a href="#">Next <i class="fa fa-angle-right"></i></a></li>
            </ul>
          </nav>
        </div>

      </div>

      @include('templates-parts.sidebar')
    </div>
  </div>
  @endsection

  @section('js')
  @endsection