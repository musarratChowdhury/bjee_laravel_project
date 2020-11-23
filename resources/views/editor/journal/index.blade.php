@extends('layouts.jb-master')
@section('title-tag', 'Article Dashboard | ')

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
                            <li><a href="{{ route('editor.journals') }}">Dashboard</a></li>
                            <li class="active">Articles</li>
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
                        <strong class="card-title">Articles</strong>
                        
                        <a href="{{ route('editor.create-journal') }}" class="btn btn-primary button-create-j">
                            <i class="fa fa-plus"></i> Add New Article
                        </a>
                    </div>
                    <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
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
                                    <th>Type</th>
                                    <th>Author</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($journals)>0 )
                            @foreach($journals as $k=>$journal)
                                <tr>
                                    <td class="text-center">{{ ($k++ + 1) }}</td>
                                    <td>{!! !empty($journal->name) ? strip_tags(str_limit($journal->name, $limit = 30, $end = '...')) :'' !!}</td>
                                    <td>{{ $journal->typeName ?? '' }}</td>
                                    <td>
                                        {{ $journal->authors_id ?? '' }}
                                        @php 
                                        $authors_ids=json_decode($journal->authors_ids);
                                        @endphp 

                                        @if(count($authors) > 0)
                                        @foreach($authors as $author)                       
                                            @if(!empty($authors_ids) && isset($authors_ids) ) 
                                                @if (in_array($author->id, $authors_ids) ) 
                                                {{$author->name}} 
                                                @if(!$loop->last)
                                                ,
                                                @endif
                                                @endif
                                            @endif                                    
                                        @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('editor.show-journal', $journal->id) }}" class="btn btn-primary" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('editor.edit-journal', $journal->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a data-action="{{ route('editor.delete-journal', $journal->id) }}" href="javascript:void(0);" class="btn btn-danger" id="delete_journal">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="5">No Article found here.</td>
                                </tr>   
                            @endif
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Author</th>
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

            if (confirm("Are you sure to delete the Article?")) {
                $('#delete_journal_form').submit();
            }  
        });

    });
})(jQuery);
</script>
@endsection