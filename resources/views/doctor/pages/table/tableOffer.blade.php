@extends('doctor.layout.layout')
@section('linkCss')
    <link rel="stylesheet" href="{{asset('css/bedge.css')}}">
    <style>
        .badge {
            cursor: pointer;
        }
        .badge a{
            color: inherit;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')

    <div class="right-panel">
        <div class="content-container bg-white rounded">
            <h3 class="pt-3 mx-3 clearfix">table Of Offer
                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('addOffer')}}">add offer</a>

            </h3>
            <div class="p-2 table-one">


                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">name_ar</th>
                        <th scope="col">name_en</th>
                        <th scope="col">price</th>
                        <th scope="col">description_ar</th>
                        <th scope="col">description_en</th>
                        <th scope="col">edit</th>
                        <th scope="col">delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr id="{{$offer->id}}">
                            <td>{{$offer->name_ar}}</td>
                            <td>{{$offer->name_en}}</td>
                            <td>{{$offer->price}}</td>
                            <td>{{$offer->description_ar}}</td>
                            <td>{{$offer->description_en}}</td>
                            <td>
                            <span class="badge badge-yellow">
                                <a href="{{route('editffer',$offer->id)}}">
                                    edit
                                </a>
	                    	</span>
                            </td>
                            <td>
                            <span class="badge badge-red delete" offer-id="{{$offer->id}}">
			                    delete
		                    </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                let offerId = $(this).attr('offer-id');
                $('#'+offerId).hide();
                //removeOffer
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax(
                    {
                        url: "{{ route('removeOffer') }}",
                        data: {
                            _token: _token,
                            id: offerId
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
