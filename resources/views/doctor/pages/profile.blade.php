@extends('doctor.layout.layout')
@section('linkCss')
    <style>
        .img-fix {
            object-fit: cover;
        }

        .bor {
            border: 2px solid #E5E5E5 !important;
        }
       .title .fa-bookmark{
            color: #39cabb;
            font-size: 16px;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')

    <div class="right-panel">
        <div class="content-container">
            <div class="outer-container">



                <section class="doctor-details bg-color-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                        <div class="clinic-details-content doctor-details-content">
                            <div class="clinic-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img class="h-100 img-fluid img-fix"
                                                                   src="{{asset($doctor->doctorprofile->profile)}}"
                                                                   alt=""></figure>
                                    <div class="content-box">

                                        <div class="like-box"><span><i
                                                    class="far fa-heart"></i></span></div>
                                        <div class="share-box">
                                            <span class="share-btn"><i
                                                    class="fas fa-share-alt"></i></span>
                                        </div>
                                        <ul class="name-box clearfix">
                                            <li class="name"><h2>Dr. {{$doctor->name}}</h2></li>
                                            <li><i class="icon-Trust-1"></i></li>
                                            <li><i class="icon-Trust-2"></i></li>
                                        </ul>
                                        <span class="designation">BDS, MDS - Oral & Maxillofacial Surgery</span>
                                        <div class="rating-box clearfix">
                                            @if(\Illuminate\Support\Facades\Auth::user()->id == $doctor->id)
                                            @else
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><i class="icon-Star"></i></li>
                                                    <li><a href="doctors-details.html">(32)</a></li>
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="text">
                                            <p>
                                                {{$doctor->doctorprofile->text}}

                                            </p>
                                        </div>
                                        <div class="lower-box clearfix">
                                            <ul class="info clearfix">
                                                <li><i class="far fa-clock"></i> age : {{$doctor->doctorprofile->age}}
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar-alt"></i>{{$doctor->doctorprofile->birthday}}
                                                </li>
                                                <li>
                                                    <i class="fas fa-venus-mars"></i>{{$doctor->doctorprofile->gender->name_en}}
                                                </li>
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>{{$doctor->doctorprofile->location->city_ar}}
                                                </li>
                                                <li><i class="fas fa-phone"></i><a
                                                        href="{{$doctor->doctorprofile->phone}}">
                                                        {{$doctor->doctorprofile->phone}}
                                                    </a></li>
                                            </ul>
                                            <div class="view-map"><a href="doctors-details.html">View Map</a></div>
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
                                                <h3>About Dr. {{$doctor->name}}:</h3>
                                                <p>
                                                    {{$doctor->doctorprofile->text}}

                                                </p>
                                                <h3>Specialities</h3>

                                                <ul class="treatments-list clearfix">
                                                    @foreach($doctor->doctorprofile->specialtiesdoctor as $specialties)
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
                                                    @foreach($doctor->doctorprofile->education as $education)

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

                                                    @foreach($doctor->doctorprofile->titlesdoctor as $titlesdoctor)

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
                                                    @foreach($doctor->doctorprofile->service as $service)
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
                                                    @foreach($doctor->doctorprofile->offer as $offer)
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
                                                    @foreach($doctor->doctorprofile->experience as $experience)
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
                                            <div class="map-inner">
                                                <div
                                                    class="google-map"
                                                    id="contact-google-map"
                                                    data-map-lat="40.712776"
                                                    data-map-lng="-74.005974"
                                                    data-icon-path="assets/images/icons/map-marker.png"
                                                    data-map-title="Brooklyn, New York, United Kingdom"
                                                    data-map-zoom="12"
                                                    data-markers='{
                                                        "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","assets/images/icons/map-marker.png"]
                                                    }'>

                                                </div>
                                            </div>
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
                                            <div class="review-inner">
                                                <div class="single-review-box">
                                                    <figure class="image-box"><img
                                                            src="assets/images/resource/review-1.jpg" alt=""></figure>
                                                    <ul class="rating clearfix">
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li class="light"><i class="icon-Star"></i></li>
                                                    </ul>
                                                    <h6>Agnes Ayres <span>- April 10, 2020</span></h6>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed eiusmod
                                                        tempor incididunt labore dolore magna aliqua enim.</p>
                                                </div>
                                                <div class="single-review-box">
                                                    <figure class="image-box"><img
                                                            src="assets/images/resource/review-2.jpg" alt=""></figure>
                                                    <ul class="rating clearfix">
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                    </ul>
                                                    <h6>Mary Astor <span>- April 09, 2020</span></h6>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed eiusmod
                                                        tempor incididunt labore dolore magna aliqua enim.</p>
                                                </div>
                                                <div class="single-review-box">
                                                    <figure class="image-box"><img
                                                            src="assets/images/resource/review-3.jpg" alt=""></figure>
                                                    <ul class="rating clearfix">
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li class="light"><i class="icon-Star"></i></li>
                                                    </ul>
                                                    <h6>Anderson <span>- April 08, 2020</span></h6>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed eiusmod
                                                        tempor incididunt labore dolore magna aliqua enim.</p>
                                                </div>
                                                <div class="single-review-box">
                                                    <figure class="image-box"><img
                                                            src="assets/images/resource/review-4.jpg" alt=""></figure>
                                                    <ul class="rating clearfix">
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li class="light"><i class="icon-Star"></i></li>
                                                    </ul>
                                                    <h6>Bradshaw <span>- April 07, 2020</span></h6>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed eiusmod
                                                        tempor incididunt labore dolore magna aliqua enim.</p>
                                                </div>
                                                <div class="single-review-box">
                                                    <figure class="image-box"><img
                                                            src="assets/images/resource/review-5.jpg" alt=""></figure>
                                                    <ul class="rating clearfix">
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li><i class="icon-Star"></i></li>
                                                        <li class="light"><i class="icon-Star"></i></li>
                                                    </ul>
                                                    <h6>Bradshaw <span>- April 26, 2020</span></h6>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed eiusmod
                                                        tempor incididunt labore dolore magna aliqua enim.</p>
                                                </div>
                                            </div>
                                            <div class="btn-box">
                                                <a href="doctors-details.html" class="theme-btn-one">Submit Review<i
                                                        class="icon-Arrow-Right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- doctor-details end -->

            </div>
        </div>
    </div>

@endsection
@section('scriptJs')
@endsection
@section('script')
@endsection

@section('page')
@endsection

@section('pageAll')
@endsection
