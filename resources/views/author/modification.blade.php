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
          <h1>Modification Info</h1>

          <ol class="sj-breadcrumb ">
            <li>
              <a href="{{url('/')}}">
                Home
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                Modification Info
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
<style>
  .message-block {
    margin: 0 0 15px;
    clear: both;
    overflow: hidden;
    border: 1px solid #ddd;
    padding: 25px;
}
</style>
<div class="container">
  <div class="row">
    <!--<div class="col-md-4">-->
    <!--  <div class="card">-->
    <!--    <div class="card-header">Author Submissions</div>-->
    <!--    <div class="card-body">-->
    <!--      <div class="list-group">-->
    <!--        <a href="{{ route('author') }}" class="list-group-item list-group-item-action active">Manuscripts in Draft</a>-->
    <!--        <a href="{{ route('startSubmission') }}" class="list-group-item list-group-item-action">Start-->
    <!--          New Submission</a>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->


    <!--</div>-->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Modification Info</div>
        <div class="card-body">
          <div class="sj-userinfoname">
          <h3>Title: {{ $journal_info->title }}</h3>
            <hr>

            <p>
            <span class="pull-left">Modification Request Date: {{ \Carbon\Carbon::parse($journal_info->modif_start)->format('d M Y') }}</span>
            <span class="pull-right">Deadline of Modification: <b style="color:red">{{ \Carbon\Carbon::parse($journal_info->modif_end)->format('d M Y') }}</b></span>
            </p>
          </div>

          @foreach($modMessReviewer as $m_r)
            @foreach($modMess as $m_m)
              @if($m_r->reviewer_id == $m_m->reviewer_id)
                <div class="message-block">
                <div class="sj-description modification-mesages">
                   <p>{{ $m_m->comments_to_author}}</p>
                </div>
                <div class="sj-downloadheader">
                  <div class="sj-title">
                    <h3>Attached Document</h3>
                    @if($m_m->file_to_author !='')
						<a href="{{ route('downloadMyReview',[$m_m->submission_id,$m_m->reviewer_id,'toAuthor'] ) }}"><i class="lnr lnr-download"></i>Download</a>
					@endif
                  </div>
                  <!--<div class="sj-docdetails">-->
                  <!--  <figure class="sj-docimg">-->
                  <!--    <img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">-->
                  <!--  </figure>-->
                  <!--  <div class="sj-docdescription">-->
                  <!--    <h4>Document Ph...01.docx</h4>-->
                  <!--    <span>File Size 500kb</span>-->
                  <!--  </div>-->
                  <!--</div>-->
                </div>
              </div>
              @endif
            @endforeach
          @endforeach
          <div class="go-modification-page text-right">
            <a href="#" class="sj-btn sj-btnactive">
              Go To Modification
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
  @endsection