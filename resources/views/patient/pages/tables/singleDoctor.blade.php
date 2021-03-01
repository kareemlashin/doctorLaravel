@extends('patient.layout.layout')
@section('linkCss')
    <style>
        input, select {
            border: 2px solid #E5E7EC !important;
            width: 100% !important;
            padding: 3px !important;
            border-radius: 5px !important;
        }

        .ey {
            color: #45C1B6 !important;
        }

        .ratee {
            color: #FCD703;
        }

        #like-button {
            color: #888;
            font-size: 16px;
            font-family: 'Heebo', sans-serif;
            background-color: transparent;
            border: 0.1em solid;
            border-radius: 1em;
            padding: 5px 40px;
            line-height: 1.2em;
            box-shadow: 0 0.25em 1em -0.25em;
            cursor: pointer;
            transition: color 150ms ease-in-out, background-color 150ms ease-in-out, transform 150ms ease-in-out;
            outline: 0;
        }

        #like-button:hover {
            color: #45C1B6;
        }

        #like-button:active {
            transform: scale(0.95);
        }

        #like-button.selected {
            color: #fff;
            background-color: #45C1B6;
            border-color: #45C1B6;
        }

        #like-button .heart-icon {
            display: inline-block;
            fill: currentColor;
            width: 0.8em;
            height: 0.8em;
            margin-right: 0.2em;
        }

        .ey {
            color: #45C1B6 !important;
        }

        .ratee {
            color: #FCD703;
        }

        #like-button {
            color: #888;
            font-size: 16px;
            font-family: 'Heebo', sans-serif;
            background-color: transparent;
            border: 0.1em solid;
            border-radius: 1em;
            padding: 5px 40px;
            line-height: 1.2em;
            box-shadow: 0 0.25em 1em -0.25em;
            cursor: pointer;
            transition: color 150ms ease-in-out, background-color 150ms ease-in-out, transform 150ms ease-in-out;
            outline: 0;
        }

        #like-button:hover {
            color: #45C1B6;
        }

        #like-button:active {
            transform: scale(0.95);
        }

        #like-button.selected {
            color: #fff;
            background-color: #45C1B6;
            border-color: #45C1B6;
        }

        #like-button .heart-icon {
            display: inline-block;
            fill: currentColor;
            width: 0.8em;
            height: 0.8em;
            margin-right: 0.2em;
        }

    </style>
@endsection

@section('namePage')
@endsection
@section('content')

    <section class="doctor-details bg-color-3 pt-0 mt-0">
        <div class="col-lg-12 col-md-12 col-sm-12 content-side">
            <div class="clinic-details-content doctor-details-content">
                <div class="clinic-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img class="h-100 img-fluid img-fix"
                                                       src="{{asset($Doctors->profile)}}"
                                                       alt=""></figure>
                        <div class="content-box">


                            <ul class="name-box clearfix">
                                <li class="name"><h2>Dr. {{$Doctors->doctorprofile->name}}</h2></li>
                                <li><i class="icon-Trust-1"></i></li>
                                <li><i class="icon-Trust-2"></i></li>
                            </ul>
                            <span class="designation">BDS, MDS - Oral & Maxillofacial Surgery</span>

                            <div class="text">
                                <p>
                                    {{$Doctors->text}}

                                </p>
                            </div>
                            <div>

                                @for($x=0; $x < round($Doctors->rate_doctor_avg_rate); $x++)
                                    <i class="fas fa-star ratee"></i>
                                @endfor
                                @if(round($Doctors->rate_doctor_avg_rate) !=5)
                                    @for($z=0; $z <5-$Doctors->rate_doctor_avg_rate ; $z++)
                                        <i class="far fa-star ratee"></i>

                                    @endfor
                                @endif

                                <span>
                                                ({{$Doctors->rate_doctor_avg_rate}})
                                            </span>

                                <div class="lower-box clearfix">
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i> age : {{$Doctors->age}}
                                        </li>
                                        <li>
                                            <i class="far fa-calendar-alt"></i>{{$Doctors->birthday}}
                                        </li>
                                        <li>
                                            <i class="fas fa-venus-mars"></i>{{$Doctors->gender->name_en}}
                                        </li>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>{{$Doctors->location->city_ar}}
                                        </li>
                                        <li><i class="fas fa-phone"></i><a
                                                href="{{$Doctors->phone}}">
                                                {{$Doctors->phone}}
                                            </a></li>
                                    </ul>
                                </div>


                                    <button type="button" class="mt-3

                                @foreach($Doctors->likesDoctor as $hasLike)
                                    @if($hasLike->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                        selected
@endif
                                    @endforeach
                                        " id="like-button"

                                            doctorId="{{$Doctors->id}}">
                                        <svg class="heart-icon" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 100 100">
                                            <path
                                                d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/>
                                        </svg>
                                        Like
                                        <span class="many-like">
                                        {{$Doctors->likes_doctor_count}}
                                </span>
                                    </button>

                                    <div class="mt-2" style="font-size: 2em;">
                                        <div class="rate"
                                             @foreach($Doctors->rateDoctor as $rate)
                                             @if($rate->user_id == $patient->id && $rate->profiledoctors_id == $Doctors->id)
                                             value-rate="{{$rate->rate}}"
                                             @else

                                             @endif
                                             @endforeach
                                             doctorId="{{$Doctors->id}}">
                                            <div id="review"></div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-box">
                        <div class="tab-btn-box centred">
                            <ul class="tab-btns tab-buttons clearfix">
                                <li class="tab-btn active-btn" data-tab="#tab-1">Overview</li>
                                <li class="tab-btn" data-tab="#tab-2">Experience</li>
                                <li class="tab-btn" data-tab="#tab-3">Location</li>
                                <li class="tab-btn" data-tab="#tab-4">Reviews</li>
                            </ul>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <div class="text">
                                        <h3>About Dr. {{$Doctors->doctorprofile->name}}:</h3>
                                        <p>
                                            {{$Doctors->text}}

                                        </p>
                                        <h3>Specialities</h3>

                                        <ul class="treatments-list clearfix">
                                            @foreach($Doctors->specialtiesdoctor as $specialties)
                                                <span
                                                    class="px-3 py-1 mx-2 rounded-pill bor mb-2 d-inline-block">{{$specialties->specialties_en}}
                                                            <img
                                                                src="{{asset($specialties->photo)}}" class="mx-2"
                                                                width="25px" height="25px"
                                                                alt="{{$specialties->specialties_en}}"
                                                            ></span>

                                            @endforeach
                                        </ul>

                                        <h3>Educational Background</h3>

                                        <ul class="list clearfix">
                                            @foreach($Doctors->education as $education)

                                                <li>{{$education->name_en}}
                                                    <div>

                                                            <span><i class="far fa-calendar-check"></i>
                                                            {{$education->presente}}% </span>
                                                        <span><i class="far fa-calendar-alt"></i>
                                                            {{$education->end_date}} </span>

                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>

                                        <h3 class="mb-1">titles </h3>

                                        <ul class="title clearfix mb-3">

                                            @foreach($Doctors->titlesdoctor as $titlesdoctor)

                                                <li><i class="far fa-bookmark my-2 mx-1"></i>{{$titlesdoctor->name_en}}

                                                </li>
                                            @endforeach
                                        </ul>


                                    </div>

                                    <div class="accordion-box">
                                        <h3> Services</h3>

                                        <div class="title-box">
                                            <h6>Service <span>Price</span></h6>
                                        </div>
                                        <ul class="accordion-inner">
                                            @foreach($Doctors->service as $service)
                                                <li class="accordion block">
                                                    <div class="acc-btn">
                                                        <div class="icon-outer"></div>
                                                        <h6>{{$service->name_en}}
                                                            <span>{{$service->price}}</span></h6>
                                                    </div>
                                                    <div class="acc-content">
                                                        <div class="text">
                                                            <p>
                                                                {{$service->description_en}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>

                                    <div class="accordion-box">
                                        <h3>Offere </h3>
                                        <div class="title-box">
                                            <h6>Offere <span>Price</span></h6>
                                        </div>
                                        <ul class="accordion-inner">
                                            @foreach($Doctors->offer as $offer)
                                                <li class="accordion block">
                                                    <div class="acc-btn">
                                                        <div class="icon-outer"></div>
                                                        <h6>{{$offer->name_en}}<span>{{$offer->price}}</span>
                                                        </h6>
                                                    </div>
                                                    <div class="acc-content">
                                                        <div class="text">
                                                            <p>
                                                                {{$offer->description_en}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>


                                </div>
                            </div>

                            <div class="tab" id="tab-2">
                                <div class="experience-box">
                                    <div class="text">
                                        <h3>Professional Experience</h3>

                                        <ul class="experience-list clearfix">
                                            @foreach($Doctors->experience as $experience)
                                                <li>
                                                    {{$experience->name_en}}:
                                                    <p>{{$experience->description_en}} <span>({{$experience->start_date}} to {{$experience->end_date}})</span>
                                                    </p>
                                                </li>

                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-3">
                                <div class="location-box">
                                    <h3>Locations</h3>

                                    <h4>New Apollo Hospital:</h4>
                                    <ul class="location-info clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i>369 San Miguel Dr Ste 200
                                            Newport <br/>Beach,CA,92660
                                        </li>
                                        <li><i class="fas fa-phone"></i><a href="tel:2265458856">+(22)
                                                65_458_856</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="review-box">
                                    <h3>Dr. Agnes Ayres Reviews</h3>
                                    <div class="rating-inner">
                                        <div class="rating-box">
                                            <h2>4.5</h2>
                                            <ul class="clearfix">
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                            </ul>
                                            <span>Based on 5 review</span>
                                        </div>


                                        <div class="rating-pregress">
                                            <div class="single-progress">
                                                <span class="porgress-bar"></span>
                                                <div class="text"><p><i class="icon-Star"></i>5 Stars</p></div>
                                            </div>
                                            <div class="single-progress">
                                                <span class="porgress-bar"></span>
                                                <div class="text"><p><i class="icon-Star"></i>4 Stars</p></div>
                                            </div>
                                            <div class="single-progress">
                                                <span class="porgress-bar"></span>
                                                <div class="text"><p><i class="icon-Star"></i>3 Stars</p></div>
                                            </div>
                                            <div class="single-progress">
                                                <span class="porgress-bar"></span>
                                                <div class="text"><p><i class="icon-Star"></i>2 Stars</p></div>
                                            </div>
                                            <div class="single-progress">
                                                <span class="porgress-bar"></span>
                                                <div class="text"><p><i class="icon-Star"></i>1 Stars</p></div>
                                            </div>
                                        </div>
                                    </div>
{{$Doctors->rateDoctor}}

                                    <div class="review-inner">
                                        @foreach($Doctors->rateDoctor as $rate)
                                            <div class="single-review-box">
                                                <figure class="image-box"><img
                                                        src="{{asset($rate->rate->profile)}}" alt=""></figure>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                </ul>
                                                <h6>{{$rate->rate->doctorprofile->name}} </h6>
                                                <p>
                                                    {{$rate->review}}
                                                </p>
                                            </div>

                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
    </section>
    <!-- doctor-details end -->

@endsection

@section('scriptJs')
    <script src="{{asset('js/rating.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let rate = 0;
            let _token = $('meta[name="csrf-token"]').attr('content');
            let value = $(".rate").attr('value-rate');
            let doctorId = $(".rate").attr('doctorId');

            $("#review").rating({
                "value": value,
                "click": function (e) {
                    rate = e.stars;
                    $.ajax(
                        {
                            url: "{{ route('rateDoctor') }}",
                            data: {
                                _token: _token,
                                rate: rate,
                                doctorId: doctorId
                            },
                            type: 'post',
                            success: function (data) {
                                location.reload();

                            },
                            error: function (error) {
                            }
                        });
                }
            });

            $("#like-button").click(function () {

                let doctorId = $(this).attr('doctorId');
                let many_like = $(".many-like").text();
                $('#like-button').toggleClass('selected');
                if ($('#like-button').hasClass('selected')) {
                    many_like = ++many_like;
                    $(".many-like").text(many_like);
                } else {
                    many_like = --many_like;
                    $(".many-like").text(many_like);
                }
                $.ajax(
                    {
                        url: "{{ route('likeDoctor') }}",
                        data: {
                            _token: _token,
                            doctorId: doctorId
                        },
                        type: 'post',
                        success: function (data) {
                        },
                        error: function (error) {

                        }
                    });


            })


        })

    </script>
@endsection
