@extends('doctor.layout.layout')
@section('linkCss')
    <link rel="stylesheet" href="{{asset('css/bedge.css')}}">
    <link rel="stylesheet" href="{{asset('css/nodata.css')}}">
    <style>
        .badge {
            cursor: pointer;
        }
        .badge a{
            color: inherit;
        }
        .fa-angry{
            color: #39cabb !important;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')


    <div class="right-panel">
        <div class="content-container bg-white rounded">
            <h3 class="pt-3 mx-3 clearfix">table Of experience
                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('addexperienceview')}}">add experience</a>

            </h3>
            <div class="p-2 table-one">

                @if(!$experiences->isEmpty())
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">name_ar</th>
                            <th scope="col">name_en</th>
                            <th scope="col">start_date</th>
                            <th scope="col">end_date</th>
                            <th scope="col">description_en</th>
                            <th scope="col">description_ar</th>
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($experiences as $experience)
                            <tr id="{{$experience->id}}">
                                <td>{{$experience->name_ar}}</td>
                                <td>{{$experience->name_en}}</td>
                                <td>{{$experience->start_date}}</td>
                                <td>{{$experience->end_date}}</td>
                                <td>{{$experience->description_en}}</td>
                                <td>{{$experience->description_ar}}</td>

                                <td>
                            <span class="badge badge-yellow">
                                <a href="{{route('editExperience',$experience->id)}}">
                                    edit
                                </a>
	                    	</span>
                                </td>
                                <td>
                            <span class="badge badge-red delete" experience-id="{{$experience->id}}">
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
                            <img src="https://image.flaticon.com/icons/svg/3003/3003613.svg" alt="searc img" height="100px" width="100px" class=" text-center" >

                        </div>
                        <h3 class="">No education please add education</h3>
                        <p>There have been no posts in this section yet</p>
                        <div class="text-center">
                            <a class=" btn-rounded theme-btn-one  py-1  " href="{{route('addeducationview')}}">add education</a>

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
        //
        $(document).ready(function () {

            $('.delete').click(function () {
                let experienceId = $(this).attr('experience-id');
                $('#'+experienceId).hide();
                //removeOffer
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax(
                    {
                        url: "{{ route('deleteExperience') }}",
                        data: {
                            _token: _token,
                            id: experienceId
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
