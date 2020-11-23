@extends('layouts.jb-master')
@section('title-tag', 'Add New Instruction | ')

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
              <li><a href="{{ route('editor.instructions') }}">instructions</a></li>
              <li class="active">Add Instruction</li>
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
            <strong>Add Instruction</strong>
          </div>


          <div class="card-body card-block">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            @if($message = Session::get('error'))
            <div class="alert alert-danger">
              <p>{{$message}}</p>
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

            <form action="{{ route('editor.store-instruction') }}" method="post" enctype="multipart/form-data" id="instruction-add-form">
              {{csrf_field()}}
              <div class="row">
                <div class="col-lg-8">
                  <div class="has-success form-group">
                    <label for="instruction" class=" form-control-label">Instruction:</label>
                    <input type="text" id="instruction" class="form-control-success form-control @error('name') is-invalid @enderror" name="instruction" required>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="has-success form-group">
                    <label for="serial_number" class=" form-control-label">Serial Number:</label>
                    <input type="text"  class="form-control-success form-control @error('name') is-invalid @enderror" name="serial_number" required>

                 </div>

                  <div class="has-success form-group">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger">
                      <i class="fa fa-ban"></i> Reset
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

    });
  })(jQuery);
</script>
@endsection