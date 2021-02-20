@extends('doctor.layout.layout')
@section('linkCss')
    <link rel="stylesheet" href="{{asset('css/bedge.css')}}">
    <link rel="stylesheet" href="{{asset('css/nodata.css')}}">
    <style>
        .badge {
            cursor: pointer;
        }

        .badge a {
            color: inherit;
        }

        .fa-angry {
            color: #39cabb !important;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')


    <div class="right-panel">
        <div class="content-container bg-white rounded">
            <h3 class="pt-3 mx-3 clearfix">table Of post
                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('addpostview')}}">add
                    post</a>

            </h3>
            <div class="p-2 table-one">
                @if(!$posts->isEmpty())

                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">tittle_ar</th>
                            <th scope="col">title_en</th>
                            <th scope="col">viewer</th>
                            <th scope="col">description_ar</th>
                            <th scope="col">description_en</th>
                            <th scope="col">photo</th>
                            <th scope="col">create_at</th>
                            <th scope="col">Tags</th>
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)

                            <tr id="{{$post->id}}">
                                <td>
                                    {{$post->tittle_ar}}
                                </td>
                                <td>
                                    {{$post->title_en}}
                                </td>
                                <td>
                                    {{$post->viewer}}
                                </td>
                                <td>
                                    {{$post->description_ar}}
                                </td>
                                <td>
                                    {{$post->description_en}}
                                </td>
                                <td>
                                    <img src="{{asset($post->photo)}}" width="50px" height="50px" alt="" srcset="">
                                </td>
                                <td>
                                    {{$post->create_at}}
                                </td>
                                <td>
                                    @foreach($post->postTags as $tag)
                                        <span class="badge badge-default d-inline-block mb-2 ">
                                            {{$tag->name_ar}}
		                                 </span>
                                    @endforeach
                                </td>

                                <td>
                            <span class="badge badge-yellow">
                                <a href="{{route('editPost',$post->id)}}">
                                    edit
                                </a>
	                    	</span>
                                </td>
                                <td>
                            <span class="badge badge-red delete" post-id="{{$post->id}}">
			                    delete
		                    </span>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                @else

                    <div class="empty_state text-center">
                        <div class="text-center">
                            <img src="https://image.flaticon.com/icons/svg/3003/3003613.svg" alt="searc img"
                                 height="100px" width="100px" class=" text-center">

                        </div>
                        <h3 class="">No education please add education</h3>
                        <p>There have been no posts in this section yet</p>
                        <div class="text-center">
                            <a class=" btn-rounded theme-btn-one  py-1  " href="{{route('addeducationview')}}">add
                                education</a>

                        </div>
                    </div>
                @endif

            </div>


        </div>
    </div>



@endsection

@section('scriptJs')
    <script type="text/javascript">
        // File Upload
        $(document).ready(function () {

            $('.delete').click(function () {
                let postId = $(this).attr('post-id');
                $('#'+postId).hide();
                //removeOffer
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax(
                    {
                        url: "{{ route('deletePost') }}",
                        data: {
                            _token: _token,
                            id: postId
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
