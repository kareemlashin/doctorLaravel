@extends('patient.layout.layout')
@section('linkCss')
@endsection
@section('namePage')
@endsection
@section('content')
    <!-- clinic-details -->


    <!-- clinic-details -->
    <section class="clinic-details bg-color-3 pt-0 mt-0">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">

                    <div class="clinic-details-content">

                        <div class="clinic-details-content">
                            <div class="clinic-block-one ">
                                <div class="inner-box pb-5">
                                    <figure class="image-box"><img src="{{asset($patient->patient->profile)}}" class=""
                                                                   alt=""></figure>
                                    <div class="content-box">

                                        <ul class="name-box clearfix">
                                            <li class="name"><h2>{{$patient->name}}</h2></li>
                                            <li><i class="icon-Trust-1"></i></li>
                                            <li><i class="icon-Trust-2"></i></li>
                                        </ul>

                                        <div class="rating-box clearfix">
                                            <ul class="rating clearfix">
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                            </ul>
                                        </div>

                                        <div class="lower-box clearfix">
                                            <ul class="info clearfix">
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>{{$patient->patient->locationPatient->country_en}}
                                                    ,{{$patient->patient->locationPatient->city_ar}}</li>
                                                <li>
                                                    <i class="fas fa-phone"></i><a>({{$patient->patient->locationPatient->code}}
                                                        ) {{$patient->patient->phone}}</a></li>
                                                <li>
                                                    <i class="fas fa-venus-mars"></i><a>{{$patient->patient->genderPatient->name_en}} </a>
                                                </li>
                                                <li>
                                                    <i class="fas fa-calendar-alt"></i><a>{{$patient->patient->birthday}}
                                                        ,({{$patient->patient->age}})Years </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tabs-box">
                            <div class="tab-btn-box centred">
                                <ul class="tab-btns tab-buttons clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1">Syndromes</li>
                                    <li class="tab-btn" data-tab="#tab-2">Analysis and x-rays</li>
                                    <li class="tab-btn" data-tab="#tab-3"> Diseases</li>
                                </ul>
                            </div>
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <div class="text">
                                            @foreach($patient->patient->patientSyndromes as $Syndromes)


                                                <h3>{{$Syndromes->name_en}}</h3>
                                                <p>
                                                    {{$Syndromes->description_en}}
                                                </p>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                                <div class="tab" id="tab-2">
                                    <div class="onboard-doctors">

                                        <h3>Xrays:</h3>
                                        @foreach($patient->patient->xRays as $xrays)
                                            <div class="team-block-one">

                                                <div class="inner-box py-5">

                                                    <figure class="image-box pb-3"><img src="{{asset($xrays->image)}}"
                                                                                        class="pb-3" alt=""></figure>
                                                    <div class="content-box d-flex align-items-center pb-3">
                                                        <div>

                                                            <div>name : {{$xrays->name_en}}</div>
                                                            <div><i class="fas fa-calendar-alt pr-1"></i>
                                                                time : {{$xrays->create_at}}</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <h3>medical test:</h3>
                                        @foreach($patient->patient->medicalTests as $medicalTest)
                                            <div class="team-block-one">

                                                <div class="inner-box py-5">

                                                    <figure class="image-box pb-3"><img
                                                            src="{{asset($medicalTest->image)}}" class="pb-3" alt="">
                                                    </figure>
                                                    <div class="content-box d-flex align-items-center pb-3">
                                                        <div>

                                                            <div>name : {{$medicalTest->name_en}}</div>
                                                            <div><i class="fas fa-calendar-alt pr-1"></i>
                                                                time : {{$medicalTest->create_at}}</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                                <div class="tab" id="tab-3">

                                    @foreach($patient->patient->patientDiseases as $Diseases)


                                        <h3>{{$Diseases->name_en}}</h3>
                                        <p>
                                            {{$Diseases->description_en}}
                                        </p>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection
@section('scriptJs')
    <script>
        $(document).ready(function () {
            $('.preloader').fadeOut();
        })

    </script>
@endsection
@section('script')
@endsection

@section('page')
@endsection

@section('pageAll')
@endsection
