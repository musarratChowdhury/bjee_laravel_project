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
                    <h1>Instruction to Authors</h1>

                    <ol class="sj-breadcrumb ">
                        <li>
                            <a href="javascript:void(0);">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                Instruction to Authors
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
                        <h3 class="text-center pagex-title">
                            Instructions to the Authors
                        </h3>

                        <ol>
                            <li>Bangladesh Journal of Extension Education (BJEE) is a half-yearly publication of the Bangladesh Agricultural Extension Society (BAES). Issues are published in June and December.</li>
                            <li>The journal accepts original research article, review article, concepts and ideas and short communication on different aspects of extension experience and insights.</li>
                            <li>The manuscript should not exceed 5,000 words along an abstract not exceeding 200 words.</li>
                            <li>Each table and figure must be submitted in publishable form within the text. As a unit of measurement metric system should be followed throughout the manuscript.</li>
                            <li>Reference cited in the text should be given following name and year system.</li>
                            <li>All references cited in the text should be listed alphabetically and presented in full using the following style.&nbsp; <br>
                                <div style="margin-bottom: 10px;"></div>
                                Rolling, N. 1988. <i>Extension Science: Information System in Agricultural Development</i>. Cambridge: Cambridge University Press. <br>
                                <div style="margin-bottom: 10px;"></div>
                                Kashem, M.A. and G.E. Jones. 1988. Small Farmers’ Perceptions of Obstacles to Improved Rice Cultivation in Bangladesh. <i>Agricultural Administration and Extension</i>, 29(4):293-300.
                                <div style="margin-bottom: 10px;"></div>


                            </li>
                            <li>The manuscript should contain the following: (i) Abstract, (ii) Introduction, (iii) Methodology, (iv) Findings and Discussion, (v) Conclusion and (vi) References</li>
                            <li>The title of the manuscript should be short and specific and should represent the exact nature of content of the article. The name(s) of the author(s) with their institutional affiliation and e-mail account and cell phone number should be given in a separate sheet of paper.</li>
                            <li>The Manuscript should be type-written in A4 size bond paper, 1.5 spaced throughout with ample margin (1 inch all sides).</li>
                            <li>A processing fee of Taka 1,600.00 (for inland) and US$ 100.00 (for overseas) is charged for a manuscript not exceeding 14 typed pages. An extra fee of Taka 200.00 for each additional page may also be charged, if necessary. The inland contributors have to pay Taka 500.00 (non-refundable) only to the Editor at the time of submission of the manuscript and the remaining amount (Taka 1,100.00) after acceptance of the manuscript by the Editorial Board. Authors are entitled to get 10 copies of reprints of their articles and a copy of the journal free of cost.</li>
                        </ol>
                    </div>
                </div>
            </div>

            @include('templates-parts.sidebar')
        </div>
    </div>
    @endsection

    @section('js')
    @endsection