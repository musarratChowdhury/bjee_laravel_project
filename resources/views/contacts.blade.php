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
                    <h1>Contacts</h1>

                    <ol class="sj-breadcrumb ">
                        <li>
                            <a href="javascript:void(0);">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                Contacts
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
                    <div class="block-lists">
                        <h3 class="pagex-title">
                            Principle Contact:
                        </h3>
                        <p>
                            <strong>Dr. Md. Golam Farouque</strong><br>
                            Editor<br>
                            Bangladesh Journal of Extension Education (BJEE)<br>
                            Phone: +880 1731 420685<br>
                            E-mail: editor.bjee@gmail.com or farouque25@bau.edu.bd

                        </p>
                    </div>
                </div>
            </div>

            @include('templates-parts.sidebar')
        </div>
    </div>
    @endsection

    @section('js')
    @endsection