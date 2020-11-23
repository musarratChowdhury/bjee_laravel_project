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
        <h1> {{ $volumeDetails->name }}</h1>

          <ol class="sj-breadcrumb ">
            <li>
              <a href="{{ route('archive') }}">
                Archive
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                {{ $volumeDetails->name }}
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
            <h2>{{ $volumeDetails->name }}</h2>
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
          
          <?php
            // dd($totalJournal);
            // echo $totalJournal.'<br>';
            // echo $arrIndex.'<br>';
            // dd('end');
          ?>
         
          <ul id="accordion" class="sj-articledetails sj-articledetailsvtwo">
            <?php
            if(count($journalDetails) > 0){
                for($i=0;$i<count($journalDetails[$arrIndex]);$i++){
            ?>

            <li id="headingOne" class="sj-articleheader">
                <div class="sj-postcontent">
                    <div class="sj-head">
                    <span class="sj-username1"><a href="#" target="_blank">{{ $journalDetails[$arrIndex][$i]['typeName'] ? $journalDetails[$arrIndex][$i]['typeName'] : '' }}</a></span>
                    <h3><a href="#" target="_blank">{{ $journalDetails[$arrIndex][$i]['journalName'] ? $journalDetails[$arrIndex][$i]['journalName'] : '' }}</a></h3>
                    </div>
                    <div class="sj-description">

                    <?php
                        if(isset($journalDetails[$arrIndex][$i]['journalAuthors'])){
                            $strAuthorName = '';
                            
                            for($j=0;$j<count($journalDetails[$arrIndex][$i]['journalAuthors']);$j++){
                                $strAuthorName .= $journalDetails[$arrIndex][$i]['journalAuthors'][$j].', ';
                            }
                            $strAuthorName = rtrim($strAuthorName, ", ");
                    ?>
                    <p>{{  $strAuthorName }}</p>
                    <?php
                        }
                    ?>    
                        
                    </div>
                  <a class="sj-btn" href="{{ url('/editor/show-journal/'.$journalDetails[$arrIndex][$i]['journalId']) }}" target="_blank">View Full Article</a>
                </div>
            </li>

            <?php
                }    
            }else{
            ?>    
                <div class="alert alert-warning" style="margin-top: 30px;">
                    <strong>Warning! </strong> No Article Found</a>.
                </div
            <?php    
            }
            ?>
           
            
          </ul>
          <nav class="sj-pagination">
            <?php
                // $totalJournal = count($journalDetails);
                // $perPageContant = $perPageContant;
                if($totalJournal > 0){
                    
                $totalPage = $totalJournal / $perPageContant;
                if($totalJournal % $perPageContant != 0){
                  $totalPage += 1;
                }
            ?>
            <ul>

              <?php
                  for ($i=1; $i <= $totalPage ; $i++) { 
              ?>
                <li class="sj-active"><a href="{{ url('/volume/'.$volumeDetails->id.'/page/'.$i) }}">{{ $i }}</a></li>
              <?php
                  }  
                  
                }else{
                    // echo "No Pagination";
                }
              ?>
  
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