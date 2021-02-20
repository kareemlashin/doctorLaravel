@extends('doctor.layout.layout')
@section('linkCss')

    <link rel="stylesheet" href="{{asset('css/bedge.css')}}">
    <link rel="stylesheet" href="{{asset('css/nodata.css')}}">
    <style>

    </style>
@endsection
@section('namePage')
@endsection
@section('content')

    <div class="right-panel">
        <div class="content-container bg-white rounded">
            <h3 class="pt-3 mx-3 clearfix">table Of service
                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('addServiceview')}}">add service</a>

            </h3>
            <div class="p-2 table-one">

                @if(!$services->isEmpty())
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">name_ar</th>
                            <th scope="col">name_en</th>
                            <th scope="col">price</th>
                            <th scope="col">description_ar </th>
                            <th scope="col">description_en </th>
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            <tr id="{{$service->id}}">
                                <td>{{$service->name_ar}}</td>
                                <td>{{$service->name_en}}</td>
                                <td>{{$service->price}}%</td>
                                <td>{{$service->description_ar}}</td>
                                <td>{{$service->description_en}}</td>
                                <td>
                            <span class="badge badge-yellow">
                                <a href="{{route('editService',$service->id)}}">
                                    edit
                                </a>
	                    	</span>
                                </td>
                                <td>
                            <span class="badge badge-red delete" service-id="{{$service->id}}">
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
                let educationId = $(this).attr('service-id');
                $('#'+educationId).hide();
                //removeOffer
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax(
                    {
                        url: "{{ route('deleteService') }}",
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
