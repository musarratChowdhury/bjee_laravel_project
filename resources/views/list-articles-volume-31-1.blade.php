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
                        <span class="sj-username1"><a href="{{ route('article-31-1')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-31-1')}}" target="_blank">Impact of ‘Foundation Training for University Teachers’ Conducted by Bangladesh Agricultural University</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>M. M. Ali, B. Mawa</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-31-1')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
            <li id="headingOne" class="sj-articleheader">
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
            </li>
          </ul>
          <nav class="sj-pagination">
            <ul>
              <li class="sj-prevpage"><a href="#"><i class="fa fa-angle-left"></i> Previous</a></li>
              <li class="sj-active"><a href="#">01</a></li>
              <li><a href="{{ url('list-articles-volume-31-2') }}">02</a></li>
              {{-- <li><a href="#">03</a></li>
              <li><a href="#">04</a></li>
              <li><a href="#">05</a></li> --}}
              <li class="sj-nextpage"><a href="{{ url('list-articles-volume-31-2') }}">Next <i class="fa fa-angle-right"></i></a></li>
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