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

                        <div class="row clearfix">
                            @foreach($doctor->doctorprofile->posts as $post)


                                <div class="col-lg-4 col-md-6 col-sm-12 news-block ">
                                <div class="news-block-one wow fadeInUp  animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box bg-white">
                                        <figure class="image-box">
                                            <img src="{{asset($post->photo)}}" alt="">
                                            <a href="{{route('getSinglePost', $post->id)}}" class="link"><i class="fas fa-link"></i></a>
                                        </figure>
                                        <div class="lower-content">
                                            <h3><a href="{{route('getSinglePost', $post->id)}}">
                                                    {{Str::limit($post->title_en, 20, $end='.......')}}

                                                </a></h3>
                                            <ul class="post-info mb-1">
                                                <li><img src="{{asset($doctor->doctorprofile->profile)}}" class="rounded-circle" width="25px" height="25px" alt="">
                                                    <a >{{$doctor->name}}</a></li>
                                                <li>{{$post->create_at}}</li>
                                            </ul>
                                            <p>
                                            {{Str::limit($post->description_en, 20, $end='.......')}}
                                                <div class="mb-2">
                                                    <!-- ->take(1)-->
                                        @foreach($post->postTags as $tag)

                                                        <span class="badge badge-info">{{$tag->name_en}}</span>

                                            @endforeach
                                            <span class="badge badge-info">....</span>

                                                </div>

                                            <div class="link"><a href="{{route('getSinglePost', $post->id)}}"><i class="icon-Arrow-Right"></i></a></div>
                                            <div class="btn-box"><a href="{{route('getSinglePost', $post->id)}}" class="theme-btn-one">Read more<i class="icon-Arrow-Right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

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
