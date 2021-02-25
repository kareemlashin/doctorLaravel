@extends('patient.layout.layout')
@section('linkCss')
    <style>
        .active {
            color: #39CABB;
        }

        .fa-star {
            color: #ffff00;
        }

        .tag {
            border: 2px solid rgba(57, 202, 187, 0.6);
            background-color: rgba(57, 202, 187, 0.4);
            color: #fff;
        }

        .base-color {
            color: rgb(57, 202, 187);

        }

        .checkbox-buttons-container input {
            position: absolute;
            left: -100vw; /* don't hide the input but move it out of view instead for better accessibility   */
        }

        .checkbox-buttons-container label {
            padding: 8px 32px;
            border: 2px solid #0060ad;
            border-radius: 5px;
            color: #0060ad;
            display: inline-block;
            position: relative;
        }

        .checkbox-buttons-container label:not(:last-child) {
            margin-right: 16px;
        }

        .checkbox-buttons-container label:hover {
            cursor: pointer;
            opacity: 0.7;
        }

        .checkbox-buttons-container input:checked + label {
            background-color: #0060ad;
            color: #fff;
        }

        .checkbox-buttons-container input:checked + label::after {
            width: 16px;
            height: 16px;
            padding: 4px;
            border: 2px solid #e9e9e9;
            border-radius: 50%;
            background: #059f00;
            content: "✔";
            font-size: 12px;
            color: #fff;
            position: absolute;
            top: -16px;
            right: -16px;
        }

        .filter span {
            padding: 3px 25px;
            border: 2px solid rgba(57, 202, 187, 0.6);
            background-color: rgba(57, 202, 187, 0.4);
            color: #fff;
            border-radius: 15px;
            cursor: pointer;
        }

        .CLEAR span {
            padding: 3px 25px;
            border: 2px solid #DC4444;
            background-color: #DC4444;
            color: #fff;
            border-radius: 15px;
            cursor: pointer;

        }

        .page {
            cursor: pointer;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')
    <div class="bg-white p-3 mb-2 rounded">
        <h6>by tags : </h6>
        <div class="my-2">
            @foreach($tags as $tag)
                <span class="checkbox-buttons-container">
            <input type="checkbox" id="{{$tag->name_en}}" name="tags[]" value="{{$tag->id}}">
            <label for="{{$tag->name_en}}">{{$tag->name_en}}</label>
        </span>
            @endforeach
        </div>
        <h6>by name : </h6>
        <div class="my-2 filter">
            <span filter-by="title_en" value="DESC">Z-A</span>
            <span filter-by="title_en" value="ASC">A-Z</span>
        </div>

        <h6>by date : </h6>
        <div class="my-2 filter">
            <span filter-by="create_at" value="DESC">last</span>
            <span filter-by="create_at" value="ASC">old</span>
        </div>

        <h6>by viewer : </h6>
        <div class="my-2 filter">
            <span filter-by="viewer" value="DESC">top</span>
            <span filter-by="viewer" value="ASC">low</span>
        </div>
        <h6>by likes : </h6>
        <div class="my-2 filter">
            <span filter-by="likes_post_count" value="DESC">big like</span>
            <span filter-by="likes_post_count" value="asc">low like</span>
        </div>
        <h6>by rate : </h6>
        <div class="my-2 filter">
            <span filter-by="rate" value="DESC">big rate</span>
            <span filter-by="rate" value="ASC">low rate</span>
        </div>
        <h6>CLEAR : </h6>
        <div class="my-2 CLEAR">
            <span> CLEAR</span>
        </div>

        <div class="w-50 mx-auto">
            <input type="text" class="w-100 rounded-pill py-2 form-control" name="" id="search">
        </div>

    </div>
    <div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="blog-grid-content">
                    <div class="row clearfix data">

                    </div>

                    <div class="pagination-wrapper">
                        <ul class="pagination">
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar-page-container end -->

    </div>

@endsection

@section('scriptJs')
    <script type="text/javascript">
        // File Upload
        //


        $(document).ready(function () {
            var searchVal = '';
            var ids = [];
            var create_at = '';
            var viewer = '';
            var likes_post_count = '';
            var rate = '';
            var title_en = '';
            var page = 1;
            var data = {
                tags: ids,
                create_at: create_at,
                viewer: viewer,
                likes_post_count: likes_post_count,
                rate: rate,
                title_en: title_en,
                page: page
            };
            $(document).on("click", ".page", function () {
                $('.page').removeClass('current');
                $(this).addClass('current');
                let num = $(this).attr('page');
                data.page = num;
                getData();

            })
            $('input[type=checkbox]').change(function () {
                ids = [];
                $('input[type=checkbox]:checked').each(function () {
                    ids.push(this.value);
                });
                data.tags = ids;
                getData();
            });
            //
            $('.filter span').click(function () {
                let filter_by = $(this).attr('filter-by');
                let value = $(this).attr('value');
                switch (filter_by) {
                    case 'create_at':
                        data.create_at = '';
                        create_at = value;
                        data.create_at = value;
                        break;
                    case 'title_en':
                        data.title_en = '';
                        title_en = value;
                        data.title_en = value;
                        break;
                    case 'viewer':
                        data.viewer = '';
                        viewer = value;
                        data.viewer = value;
                        break;
                    case 'likes_post_count':
                        data.likes_post_count = '';
                        likes_post_count = value;
                        data.likes_post_count = value;
                        break;
                    case 'rate':
                        data.rate = '';
                        rate = value;
                        data.rate = value;
                        break;
                    default:
                        break

                }
                getData();
            });
            $('.CLEAR span').click(function () {
                data = {
                    tags: [],
                    create_at: '',
                    viewer: '',
                    likes_post_count: '',
                    rate: ''
                };
                $('input:checkbox').attr('checked', false);
                getData();

            })

            function getData() {
                $('.data').html('');

                $.ajax({  //create an ajax request to display.php
                    type: "GET",
                    url: "{{route('getPosts')}}",
                    data: data,
                    success: function (res) {
                        let data = res.data;
                        let paginate = res.links;
                        let allData = '';
                        $('.pagination').html('');

                        if (searchVal === '') {
                            for (var i in data) {
                                allData += `
                        <div class="col-lg-4 col-md-4 col-sm-12  news-block mb-4">
                            <div class="news-block-one bg-white">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="http://127.0.0.1:8000/${data[i].photo}" alt="">
                                        <a href="singlePost/${data[i].id}" class="link"><i class="fas fa-link"></i></a>

                                </figure>
                                    <div class="lower-content">
                                        <h3><a href="blog-details.html">${data[i].title_en}</a>
                                        </h3>
                                        <ul class="post-info">
                                            <li><img src="http://127.0.0.1:8000/${data[i].user.profile}" class="rounded-circle" height="40px" width="40px" alt=""><a href="index.html">
                                                    ${data[i].user.doctorprofile.name}
                                    </a>
                                </li>
                                 <li>

                                    ${data[i].ago.y != 0 ? data[i].ago.y : ''} ${data[i].ago.y != 0 ? 'Years ago' : ''}
                                    ${data[i].ago.d != 0 ? data[i].ago.d : 'today'} ${data[i].ago.d != 0 ? 'Days ago' : ''}
                                </li>
                                 </ul>
                                    <p>
                                    ${data[i].description_en}
                                    </p>
                                  <div>
                                  <div>

                                    <i class="far fa-eye base-color"></i>
                                    (${data[i].viewer})
                                  </div>

                                  <div>
                                    ${data[i].likes_post_count > 0 ? '<i class="fas fa-heart active"></i> ' : '<i class="fas fa-heart"></i>'}
                                    (${data[i].likes_post_count})
                                  </div>
                                <div>

                                ${data[i].postrate_avg_rate == null || 0 ?
                                    '<i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 1 ?
                                    '<i class="fas fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 2 ?
                                    '<i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 3 ?
                                    '<i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 4 ?
                                    '<i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="far fa-star"></i>' : ''}
                                ${Math.round(data[i].postrate_avg_rate) == 5 ?
                                    '<i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' +
                                    ' <i class="fas fa-star"></i>' : ''}

                                (${data[i].postrate_count})
                                </div>
                                </div>
                                <div class="mb-3 mt-1">
                                ${(function fun() {
                                    let r = ``;
                                    for (let z = 0; z < data[i].post_tags.length; z++) {
                                        r += '<span class="mx-1 py-1 px-3 tag rounded">'
                                            + data[i].post_tags[z].name_en +
                                            '</span>';
                                    }
                                    return r;

                                })()}

</div>
                                        <div class="link"><a href="singlePost/${data[i].id}"><i
                                                    class="icon-Arrow-Right"></i></a></div>
                                        <div class="btn-box"><a href="singlePost/${data[i].id}" class="theme-btn-one">Read more<i
                                                    class="icon-Arrow-Right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                            }
                        } else {
                            for (var i in data) {
                                if (data[i].title_en.toLocaleLowerCase().includes(searchVal.toLocaleLowerCase())) {

                                    allData += `
                        <div class="col-lg-4 col-md-4 col-sm-12  news-block mb-4">
                            <div class="news-block-one bg-white">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="http://127.0.0.1:8000/${data[i].photo}" alt="">
                                        <a href="singlePost/${data[i].id}" class="link"><i class="fas fa-link"></i></a>

                                </figure>
                                    <div class="lower-content">
                                        <h3><a href="blog-details.html">${data[i].title_en}</a>
                                        </h3>
                                        <ul class="post-info">
                                            <li><img src="http://127.0.0.1:8000/${data[i].user.profile}" class="rounded-circle" height="40px" width="40px" alt=""><a href="index.html">
                                                    ${data[i].user.doctorprofile.name}
                                    </a>
                                </li>
                                 <li>

                                    ${data[i].ago.y != 0 ? data[i].ago.y : ''} ${data[i].ago.y != 0 ? 'Years ago' : ''}
                                    ${data[i].ago.d != 0 ? data[i].ago.d : 'today'} ${data[i].ago.d != 0 ? 'Days ago' : ''}
                                </li>
                                 </ul>
                                    <p>
                                    ${data[i].description_en}
                                    </p>
                                  <div>
                                  <div>

                                    <i class="far fa-eye base-color"></i>
                                    (${data[i].viewer})
                                  </div>

                                  <div>
                                    ${data[i].likes_post_count > 0 ? '<i class="fas fa-heart active"></i> ' : '<i class="fas fa-heart"></i>'}
                                    (${data[i].likes_post_count})
                                  </div>
                                <div>

                                ${Math.round(data[i].postrate_avg_rate) == null || 0 ?
                                        '<i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 1 ?
                                        '<i class="fas fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 2 ?
                                        '<i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 3 ?
                                        '<i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' : ''}

                                ${Math.round(data[i].postrate_avg_rate) == 4 ?
                                        '<i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="far fa-star"></i>' : ''}
                                ${Math.round(data[i].postrate_avg_rate) == 5 ?
                                        '<i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' +
                                        ' <i class="fas fa-star"></i>' : ''}

                                (${data[i].postrate_count})
                                </div>
                                </div>
                                <div class="mb-3 mt-1">
                                ${(function fun() {
                                        let r = ``;
                                        for (let z = 0; z < data[i].post_tags.length; z++) {
                                            r += '<span class="mx-1 py-1 px-3 tag rounded">'
                                                + data[i].post_tags[z].name_en +
                                                '</span>';
                                        }
                                        return r;

                                    })()}

</div>
                                        <div class="link"><a href="singlePost/${data[i].id}"><i
                                                    class="icon-Arrow-Right"></i></a></div>
                                        <div class="btn-box"><a href="singlePost/${data[i].id}" class="theme-btn-one">Read more<i
                                                    class="icon-Arrow-Right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                                }
                            }
                        }
                        let links = '';
                        for (var p in paginate) {
                            if (typeof paginate[p].label === 'string') {
                                links += ``;
                            } else {
                                links += `
                                <li><a class="${paginate[p].active ? 'current' : ''} page" page="${paginate[p].label}">${paginate[p].label}</a></li>
                            `;
                            }
                        }
                        $('.data').html(allData)
                        $('.pagination').html(links);
                    },
                    error: function () {

                    }

                });
            }

            getData();
            $('#search').keyup(function () {
                $('.data').html('');
                searchVal = $(this).val();
                getData();
            })


        })
    </script>
@endsection

@section('page')
@endsection

@section('pageAll')
@endsection
