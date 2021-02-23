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
        .fix-table{
            max-width: 900px;
            overflow-x: scroll;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')

    <div class="right-panel">
        <div class="content-container bg-white rounded">
            <h3 class="pt-3 mx-3 clearfix">table Of Offer
                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('addeducationview')}}">add education</a>

            </h3>

            <div class="p-2 table-one fix-table">

                @if(!$doctor->doctorprofile->clinics->isEmpty())
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">tittle_ar</th>
                            <th scope="col">tittle_en</th>
                            <th scope="col">description_ar</th>
                            <th scope="col">description_en</th>
                            <th scope="col">address</th>
                            <th scope="col">lat/lang</th>
                            <th scope="col">phone</th>
                            <th scope="col">clinic_image</th>
                            <!--
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doctor->doctorprofile->clinics as $clinic)
                            <tr id="{{$clinic}}">
                                <td>{{$clinic->tittle_ar}}</td>
                                <td>{{$clinic->tittle_en}}</td>
                                <td>{{$clinic->description_ar}}</td>
                                <td>{{$clinic->description_en}}</td>
                                <td>{{$clinic->address}}</td>
                                <td>{{$clinic->lat}}/{{$clinic->lang}}</td>
                                <td>{{$clinic->phone}}</td>
                                <td>
                                    @foreach($clinic->clinicImage as $img)
                                    <img src="{{asset($img->image)}}" class="d-inline-block my-1" height="30px" width="40px">
                                    @endforeach
                                </td>
                                <!--
                                <td>
                            <span class="badge badge-yellow">
                                <a href="{{route('editEducation',$clinic->id)}}">
                                    edit
                                </a>
	                    	</span>
                                </td>
                                <td>
                            <span class="badge badge-red delete" clinic-id="{{$clinic->id}}">
			                    delete
		                    </span>
                                </td>
                                -->
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
                let educationId = $(this).attr('education-id');
                $('#'+educationId).hide();
                //removeOffer
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax(
                    {
                        url: "{{ route('deleteEducation') }}",
                        data: {
                            _token: _token,
                            id: educationId
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
