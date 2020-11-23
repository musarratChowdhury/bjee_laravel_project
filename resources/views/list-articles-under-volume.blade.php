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
          <h1>Volume-32, N-02</h1>

          <ol class="sj-breadcrumb ">
            <li>
              <a href="javascript:void(0);">
                Home
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                Volume-32, N-02
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
            <h2>Volume-32, N-02</h2>
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
              <div class="sj-detailstime">
                <span><i class="ti-calendar"></i>Jun 27, 2018 11:30</span>
                <span><i class="ti-layers"></i>Research Article/Findings</span>
                <h4>4 Ways You Can Grow Your Creativity Using technology</h4>
              </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
              <div class="sj-detailstime">
                <span><i class="ti-calendar"></i>Jun 27, 2018 11:30</span>
                <span><i class="ti-layers"></i>Research Article/Findings</span>
                <h4>4 Ways You Can Grow Your Creativity Using technology</h4>
              </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
              <div class="sj-detailstime">
                <span><i class="ti-calendar"></i>Jun 27, 2018 11:30</span>
                <span><i class="ti-layers"></i>Research Article/Findings</span>
                <h4>4 Ways You Can Grow Your Creativity Using technology</h4>
              </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
              <div class="sj-detailstime">
                <span><i class="ti-calendar"></i>Jun 27, 2018 11:30</span>
                <span><i class="ti-layers"></i>Research Article/Findings</span>
                <h4>4 Ways You Can Grow Your Creativity Using technology</h4>
              </div>
            </li>
            <li id="headingOne" class="sj-articleheader">
              <div class="sj-detailstime">
                <span><i class="ti-calendar"></i>Jun 27, 2018 11:30</span>
                <span><i class="ti-layers"></i>Research Article/Findings</span>
                <h4>4 Ways You Can Grow Your Creativity Using technology</h4>
              </div>
            </li>
          </ul>
          <nav class="sj-pagination">
            <ul>
              <li class="sj-prevpage"><a href="#"><i class="fa fa-angle-left"></i> Previous</a></li>
              <li class="sj-active"><a href="#">01</a></li>
              <li><a href="#">02</a></li>
              <li><a href="#">03</a></li>
              <li><a href="#">04</a></li>
              <li><a href="#">05</a></li>
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