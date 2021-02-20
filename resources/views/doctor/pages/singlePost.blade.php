@extends('doctor.layout.layout')
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

    <div class="right-panel">
        <div class="content-container">
            <section class="sidebar-page-container">


                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="blog-details-content ">
                            <div class="news-block-one ">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="{{asset($doctor->doctorprofile->posts[0]->photo)}}" alt="">

                                    </figure>
                                    <div class="lower-content bg-white px-4">
                                        <h3>{{$doctor->doctorprofile->posts[0]->title_en}}</h3>
                                        <div>
                                            @for($x=0; $x <$doctor->doctorprofile->posts[0]->postrate_avg_rate; $x++)
                                                <i class="fas fa-star ratee"></i>
                                            @endfor
                                            <span>
                                                ({{$doctor->doctorprofile->posts[0]->postrate_count}})
                                            </span>
                                        </div>
                                        <ul class="post-info">
                                            <li><img width="40px" height="40px" class="rounded-circle"
                                                     src="{{asset($doctor->doctorprofile->posts[0]->user->profile)}}"
                                                     alt="">
                                                <a>
                                                    {{$doctor->doctorprofile->posts[0]->user->doctorprofile->name}}
                                                </a></li>
                                            <li>{{$doctor->doctorprofile->posts[0]->create_at}}</li>
                                            <li class="ey">
                                                {{$doctor->doctorprofile->posts[0]->viewer}} <i class="far fa-eye"></i>
                                            </li>
                                        </ul>
                                        <p>
                                            {{$doctor->doctorprofile->posts[0]->description_en}}</p>
                                        <div>
                                            @foreach($doctor->doctorprofile->posts[0]->postTags as $tag)
                                                <span class="badge badge-info">{{$tag->name_en}}</span>
                                            @endforeach
                                        </div>

                                        <div class="mt-2" style="font-size: 2em;">
                                            <div class="rate"
                                                 @foreach($doctor->doctorprofile->posts[0]->postrate as $rate)
                                                 @if($rate->user_id == $doctor->id && $rate->post_id == $doctor->doctorprofile->posts[0]->id)

                                                 value-rate="{{$rate->rate}}"

                                                 @else
                                                 value-rate="0"
                                                 @endif
                                                 @endforeach

                                                 post="{{$doctor->doctorprofile->posts[0]->id}}">
                                                <div id="review"></div>
                                            </div>
                                        </div>

                                        <button type="button" class="mt-3
                                        @foreach($doctor->likesUserPost as $like)
                                            @if($doctor->doctorprofile->posts[0]->id==$like->post_id && $doctor->id == $like->user_id)
                                            selected
                                            @endif
                                        @endforeach"

                                                post="{{$doctor->doctorprofile->posts[0]->id}}"
                                                id="like-button">
                                            <svg class="heart-icon" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 100 100">
                                                <path
                                                    d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/>
                                            </svg>
                                            Like <span class="many-like">

                                                                                                {{$doctor->doctorprofile->posts[0]->likes_post_count}}

                                            </span>
                                        </button>


                                    </div>
                                </div>
                            </div>


                            <div class="comment-box bg-white my-5">
                                <div class="group-title ">
                                    <h3>Comments</h3>
                                </div>
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="assets/images/news/comment-1.png" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info">
                                            <h5>Leroy Anderson</h5>
                                            <span class="comment-time">April 10, 2020</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor
                                            incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exerc itation ullamco laboris.</p>
                                        <a href="blog-details.html" class="reply-btn">Reply</a>
                                    </div>
                                </div>
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="assets/images/news/comment-2.png" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info">
                                            <h5>Leroy Anderson</h5>
                                            <span class="comment-time">April 09, 2020</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor
                                            incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exerc itation ullamco laboris.</p>
                                        <a href="blog-details.html" class="reply-btn">Reply</a>
                                    </div>
                                </div>
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="assets/images/news/comment-3.png" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info">
                                            <h5>Leroy Anderson</h5>
                                            <span class="comment-time">April 08, 2020</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor
                                            incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exerc itation ullamco laboris.</p>
                                        <a href="blog-details.html" class="reply-btn">Reply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-form-area">
                                <div class="group-title">
                                    <h3>Leave a Comment</h3>
                                </div>
                                <form action="http://azim.commonsupport.com/Docpro/blog-details.html" method="post"
                                      class="comment-form">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="fname" placeholder="First Name" required="">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="lname" placeholder="Last Name" required="">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="email" name="email" placeholder="Email Address" required="">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="phone" placeholder="Phone" required="">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <textarea name="message" placeholder="Leave A Comment"></textarea>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                            <button type="submit" class="theme-btn-one">Send Message<i
                                                    class="icon-Arrow-Right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="blog-sidebar">
                            <div class="sidebar-widget sidebar-search">
                                <div class="widget-title">
                                    <h3>Search</h3>
                                </div>
                                <div class="search-inner">
                                    <form action="http://azim.commonsupport.com/Docpro/blog-3.html" method="post"
                                          class="search-form">
                                        <div class="form-group">
                                            <input type="search" name="search-field" placeholder="Search" required="">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-widget category-widget">
                                <div class="widget-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list clearfix">
                                        <li><a href="blog-details.html">Cardiology</a></li>
                                        <li><a href="blog-details.html">Dermatology</a></li>
                                        <li><a href="blog-details.html">Family Medicine</a></li>
                                        <li><a href="blog-details.html">Obstetrics & Gynecology</a></li>
                                        <li><a href="blog-details.html">Oncology</a></li>
                                        <li><a href="blog-details.html">Orthopedic Surgery</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget post-widget">
                                <div class="widget-title">
                                    <h3>Recent Posts</h3>
                                </div>
                                <div class="post-inner">
                                    <div class="post">
                                        <figure class="post-thumb"><a href="blog-details.html"><img
                                                    src="assets/images/news/post-1.jpg" alt=""></a></figure>
                                        <h5><a href="blog-details.html">Baking can be done with a few things.</a></h5>
                                        <p>April 10, 2020</p>
                                    </div>
                                    <div class="post">
                                        <figure class="post-thumb"><a href="blog-details.html"><img
                                                    src="assets/images/news/post-2.jpg" alt=""></a></figure>
                                        <h5><a href="blog-details.html">Great food is not just eating energy.</a></h5>
                                        <p>April 09, 2020</p>
                                    </div>
                                    <div class="post">
                                        <figure class="post-thumb"><a href="blog-details.html"><img
                                                    src="assets/images/news/post-3.jpg" alt=""></a></figure>
                                        <h5><a href="blog-details.html">The smell of good bread baking.</a></h5>
                                        <p>April 08, 2020</p>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget archives-widget">
                                <div class="widget-title">
                                    <h3>Archives</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="archives-list clearfix">
                                        <li><a href="blog-details.html">November 2016 <span>(5)</span></a></li>
                                        <li><a href="blog-details.html">December 2017 <span>(7)</span></a></li>
                                        <li><a href="blog-details.html">January 2018 <span>(3)</span></a></li>
                                        <li><a href="blog-details.html">February 2019 <span>(2)</span></a></li>
                                        <li><a href="blog-details.html">March 2020 <span>(9)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget sidebar-tags">
                                <div class="widget-title">
                                    <h3>Tags</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="tags-list clearfix">
                                        <li><a href="blog-details.html">Medicine</a></li>
                                        <li><a href="blog-details.html">Treatment</a></li>
                                        <li><a href="blog-details.html">Pills</a></li>
                                        <li><a href="blog-details.html">Specialist</a></li>
                                        <li><a href="blog-details.html">Doctors</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- sidebar-page-container end -->


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
                            url: "{{ route('addRate') }}",
                            data: {
                                _token: _token,
                                rate: rate,
                                post: post
                            },
                            type: 'post',
                            success: function (data) {
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
                        url: "{{ route('like') }}",
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

@section('page')
@endsection

@section('pageAll')
@endsection

