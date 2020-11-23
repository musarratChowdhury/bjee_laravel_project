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
          <h1>Volume 30, Number 2, 2018</h1>

          <ol class="sj-breadcrumb ">
            <li>
              <a href="javascript:void(0);">
                Home
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                Volume 30, Number 2, 2018
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
            <h2>Volume 30, Number 2, 2018</h2>
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
                        <span class="sj-username1"><a href="{{ route('article-01')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-01')}}" target="_blank">Postharvest grain storage techniques</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>L. L. Adefalu, O. D. Olorunfemi, A. S. Aliyu, M. T. Salman</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-01')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-02')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-02')}}" target="_blank">Tribal women's participation in biochar production</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>M. R. Karim, P. Kisku, M. F. Hasan</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-02')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-03')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-03')}}" target="_blank">Farm households sanitary practices</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>L. L. Adefalu, O. P. Olabanji, H. K. Shittu</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-03')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-04')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-04')}}" target="_blank">Problems confrontation in professional training</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>M. N. A. S. Mithun, M. J. Hoque, M. H. Rahman</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-04')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-05')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-05')}}" target="_blank">Livelihood changes of common interest group</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>M. M. Rana, M. G. Farouque, M. Z. Rahman</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-05')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-06')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-06')}}" target="_blank">Distributive family expenditure</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>R. Chatterjee, S. K. Acharya, S. Mitra</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-06')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-07')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-07')}}" target="_blank">Resilience of riverine households</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>R. R. Kundu, M. Z. Rahman, M. G. Farouque</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-07')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-08')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-08')}}" target="_blank">Yield of mango marketed in Malda</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>S. K. Acharya, R. Chatterjee, D. Talukder</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-08')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-09')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-09')}}" target="_blank">Practice of higher education pedagogy</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>M. N. I. Siddque, K. S. Islam, M. Habib</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-09')}}" target="_blank">View Full Article</a>
                </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                        <span class="sj-username1"><a href="{{ route('article-10')}}" target="_blank">Research Article</a></span>
                        <h3><a href="{{ route('article-10')}}" target="_blank">Livelihood status of women in haor</a></h3>
                    </div>
                    <div class="sj-description">
                        <p>F. Yeasmin, M. A. M. Miah, M. H. Rahman, M. Z. Rahman</p>
                    </div>
                    <a class="sj-btn" href="{{ route('article-10')}}" target="_blank">View Full Article</a>
                </div>
            </li>
          </ul>
          <nav class="sj-pagination">
            <ul>
              <li class="sj-prevpage"><a href="#"><i class="fa fa-angle-left"></i> Previous</a></li>
              <li class="sj-active"><a href="#">01</a></li>
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