@extends('layouts.jb-master')
@section('title-tag', 'Edit Journal | ')

@section('content')
<style>
  ul {
    list-style: none;
  }

  .alert.alert-success p {
    margin: 0;
  }
</style>
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row m-0">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ route('editor.journals') }}">Dashboard</a></li>
              <li><a href="{{ route('editor.journals') }}">Journals</a></li>
              <li class="active">Edit Journal</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <strong>Edit Journal</strong>
          </div>


          <div class="card-body card-block">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="{{ route('editor.update-journal', $journal->id) }}" method="post" enctype="multipart/form-data" id="journal-edit-form">
              {{csrf_field()}}              
              @method('PUT')
              <div class="row">
                <div class="col-lg-8">
                  <div class="has-success form-group">
                    <label for="name" class=" form-control-label">Journal Name:</label>
                    <input type="text" id="name" class="form-control-success form-control @error('name') is-invalid @enderror" name="name" required value="{{ $journal->name ?? '' }}">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="has-success form-group">
                    <label for="pdf" class=" form-control-label">Journal PDF:</label>

                    <iframe frameborder="0" src="{{ asset('/journals/pdf').'/'.$journal->volume.'/'.$journal->pdf }}" style="width: 100%; height: 860px;margin-bottom: 10px; display: inline-block;"></iframe>
                    <input type="file" id="pdf" class="form-control-success form-control @error('name') is-invalid @enderror" style="height: auto;" name="pdf" value="{{ $journal->pdf ?? '' }}"/>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                  </div>

                  <div class="has-success form-group">
                    <label for="authors_ids" class=" form-control-label">Author(s):</label>

                    <select name="authors_ids[]" id="authors_ids" class="form-control-success form-control @error('name') is-invalid @enderror standardSelect" multiple required>    
                      @php 
                      $authors_ids=json_decode($journal->authors_ids);
                      @endphp 
                      <option value="">Select Authors</option>
                      @if(count($authors) > 0)
                      @foreach($authors as $author) 
                      <option value="{{$author->id}}"
                        <?php if(!empty($authors_ids) && isset($authors_ids) ) { 
                                if (in_array($author->id, $authors_ids) ){ 
                                echo'selected'; 
                                }
                        } ?>
                      > {{$author->name}}</option>
                      @endforeach
                      @endif
                    </select>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="has-success form-group">
                    <label for="type" class=" form-control-label">Journal Type:</label>
                    <select name="type" id="type" class="form-control-success form-control @error('name') is-invalid @enderror" required>
                      <option value="" disabled>Select Journal Type...</option>
                      @foreach($types as $k=>$type)
                      <option value="{{$type->id}}"  {{ ($journal->type ==$type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                      @endforeach
                      <!--<option value="Research Article" {{ ($journal->type =='Research Article') ? 'selected' : '' }}>Research Article</option>-->
                      <!--<option value="Food Analysis"{{ ($journal->type =='Food Analysis') ? 'selected' : '' }}>Food Analysis</option>-->
                      <!--<option value="Insect Pesticites"{{ ($journal->type =='Insect Pesticites') ? 'selected' : '' }}>Insect Pesticites</option>-->
                    </select>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="has-success form-group">
                    <label for="volume" class=" form-control-label">Journal Volume:</label>
                    <select name="volume" id="volume" class="form-control-success form-control @error('name') is-invalid @enderror" required>
                      <option value="" disabled>Select Journal Volume...</option>
                      @foreach($volumes as $k=>$volume)
                      <option value="{{$volume->id}}" {{ ($journal->volume ==$volume->id) ? 'selected' : '' }}>{{ $volume->name }}</option>
                      @endforeach
                
                    </select>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="has-success form-group">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-edit"></i> Update
                    </button>
                    
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  (function($) {
    "use strict";

    function readURL1(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('iframe').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $(document).ready(function() {

      $("#pdf").change(function() {
        if($('#pdf').val() != '') {            
          var filename = $('#pdf').val();    
          var ext = filename.split('.').pop().toLowerCase();
          if($.inArray(ext, ['pdf']) == -1) {
              $('#pdf').val('');              
              $('iframe').hide().removeAttr('src');
              alert('Please upload only pdf format file.');
              return false;
          } else {
            readURL1(this);
            $('iframe').show();
          } 
        }
        // $(this).siblings('span').addClass('uploaded').text('replace image')
        //   .siblings('.image_preview').addClass('active');
      });

      $('#authors_ids').select2({
        placeholder: "Select Journal Author...",
        allowClear: true
      });
      
      
      $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
      });

    });
  })(jQuery);
</script>
@endsection