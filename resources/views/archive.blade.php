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
          <h1>Archive</h1>

          <ol class="sj-breadcrumb ">
            <li>
              <a href="javascript:void(0);">
                Home
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                Archive
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
            <h2>Archive</h2>
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
          <ul id="accordion" class="sj-articledetails sj-articlearchive sj-articledetailsvtwo">
            @foreach($allVolumes as $volume)
            <li id="headingOne" class="sj-articleheader">
              <div class="sj-detailstime">
                <a href={{ url('/volume/'.$volume->id) }}>
                <h4>{{ $volume->name}}</h4>
                </a>
              </div>
            </li>
            @endforeach
            
          </ul>
          <nav class="sj-pagination">
            <ul>
              <li class="sj-prevpage"><a href="#" disable><i class="fa fa-angle-left"></i> Previous</a></li>
              <li class="sj-active"><a href="#">01</a></li>
              {{-- <li><a href="#">02</a></li>
              <li><a href="#">03</a></li>
              <li><a href="#">04</a></li>
              <li><a href="#">05</a></li> --}}
              <li class="sj-nextpage"><a href="#" disable>Next <i class="fa fa-angle-right"></i></a></li>
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