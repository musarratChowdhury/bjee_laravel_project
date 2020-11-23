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
                    <h1>Utilization of Aqua Drugs for Fish Health Management by the Fish Farmers: Field Level Analysis</h1>

                    <ol class="sj-breadcrumb ">
                        <li>
                            <a href="{{url('/')}}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                Utilization of Aqua ...
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
                <div id="sj-content" class="sj-content">
                    <div class="sj-articledetail">
                        <iframe src="{{ url('/articles/Utilization-of-Aqua-Drugs-for-Fish-Health-Management.pdf')}}" frameborder="0" style="width: 100%; height: 900px;"></iframe>
                    </div>
                </div>
            </div>

            @include('templates-parts.sidebar')
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection