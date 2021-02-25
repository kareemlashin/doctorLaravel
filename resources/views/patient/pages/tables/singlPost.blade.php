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

    </style>
@endsection

@section('namePage')
@endsection
@section('content')

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 content-side">
            <div class="blog-details-content ">
                <div class="news-block-one ">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="{{asset($post->photo)}}" alt="">

                        </figure>
                        <div class="lower-content bg-white px-4">
                            <h3>{{$post->title_en}}</h3>
                            <div>
                                @for($x=0; $x <round($post->postrate_avg_rate); $x++)
                                    <i class="fas fa-star ratee"></i>
                                @endfor
                                @if(round($post->postrate_avg_rate) !=5)
                                    @for($z=0; $z <5-$post->postrate_avg_rate ; $z++)
                                        <i class="far fa-star ratee"></i>

                                    @endfor
                                @endif

                                <span>
                                                ({{$post->postrate_count}})
                                            </span>
                            </div>
                            <ul class="post-info">
                                <li><img width="40px" height="40px" class="rounded-circle"
                                         src="{{asset($post->user->profile)}}"
                                         alt="">
                                    <a>
                                        {{$post->user->doctorprofile->name}}
                                    </a></li>
                                <li>{{$post->create_at}}</li>
                                <li class="ey">
                                    {{$post->viewer}} <i class="far fa-eye"></i>
                                </li>
                            </ul>
                            <p>
                                {{$post->description_en}}</p>
                            <div>
                                @foreach($post->postTags as $tag)
                                    <span class="badge badge-info">{{$tag->name_en}}</span>
                                @endforeach
                            </div>

                            <div class="mt-2" style="font-size: 2em;">
                                <div class="rate"
                                     @foreach($post->postrate as $rate)
                                     @if($rate->user_id == $patient->id && $rate->post_id == $post->id)
                                     value-rate="{{$rate->rate}}"
                                     @else

                                     @endif
                                     @endforeach
                                     post="{{$post->id}}">
                                    <div id="review"></div>
                                </div>
                            </div>
                            <button type="button" class="mt-3
                            @foreach($patient->likesUserPost as $like)
                            @if($post->id==$like->post_id && $patient->id == $like->user_id)
                                selected
                            @endif
                            @endforeach"
                                    post="{{$post->id}}"
                                    id="like-button">
                                <svg class="heart-icon" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 100 100">
                                    <path
                                        d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/>
                                </svg>
                                Like <span class="many-like">
                                    {{$post->likes_post_count}}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptJs')
    <script src="{{asset('js/rating.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let rate = 0;
            let _token = $('meta[name="csrf-token"]').attr('content');
            let value = $(".rate").attr('value-rate');
            let post = $(".rate").attr('post');

            $("#review").rating({
                "value": value,
                "click": function (e) {
                    rate = e.stars;
                    $.ajax(
                        {
                            url: "{{ route('ratingPostPatient') }}",
                            data: {
                                _token: _token,
                                rate: rate,
                                post: post
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

                let postid = $(this).attr('post');
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
                        url: "{{ route('likePostPatient') }}",
                        data: {
                            _token: _token,
                            post: postid
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
