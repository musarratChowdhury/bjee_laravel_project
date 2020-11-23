@extends('layouts.jb-master')
@section('title-tag', 'Volume Dashboard | ')

@section('content')
<style>
  ul {
    list-style: none;
  }

  .alert.alert-success p {
    margin: 0;
  }
  .card-header {
      overflow:hidden;
      display: flex;
      flex-flow: row wrap;
      justify-content: space-between;
      align-items: center;
  }
  .card-header .card-title {
      margin-bottom: 0
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
                            <li><a href="">Dashboard</a></li>
                            <li class="active">Volumes</li>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Volumes</strong>
                        
                        <a href="{{ route('editor.create-volume') }}" class="btn btn-primary button-create-j">
                            <i class="fa fa-plus"></i> Add New Volume
                        </a>
                    </div>
                    <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                    <strong>Whoops!</strong> Something went wrong.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                    @endif

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($volumes)>0 )
                                @foreach($volumes as $k=>$volume)
                                    <tr>
                                        <td class="text-center">{{ ($k++ + 1) }}</td>
                                        <td>{!! !empty($volume->name) ? strip_tags(str_limit($volume->name, $limit = 30, $end = '...')) :'' !!}</td>
                                        <td class="text-center">
                                            <div class="btn-group ">
                                            <a href="{{ route('editor.show-volume', $volume->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('editor.edit-volume', $volume->id) }}" class="btn btn-info btn-sm" style="margin-left:5px; margin-right:5px">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form action="{{route('editor.delete-volume',$volume->id)}}" method="POST" onsubmit="return confirm('Are you sure?')">
                                               @csrf 
                                              @method('delete')
                                               <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delete </button>
                                            
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="5">No journal found here.</td>
                                    </tr>   
                                @endif
                                
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete_journal_form" method="POST">
    @csrf
    @method('DELETE')  
</form>
@endsection

@section('script')
<script>
(function($) {
    "use strict";

    $(document).ready(function() {

        $(document).on('click', '#delete_journal', function() {
            // Delete form action set with id
            $('#delete_journal_form').attr('action', $(this).attr('data-action'));

            if (confirm("Are you sure to delete the journal?")) {
                $('#delete_journal_form').submit();
            }  
        });

    });
})(jQuery);
</script>
@endsection