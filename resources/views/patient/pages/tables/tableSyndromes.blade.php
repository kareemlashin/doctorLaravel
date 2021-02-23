@extends('patient.layout.layout')
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

        <div class=" bg-white rounded">
            <h3 class="pt-3 mx-3 clearfix">table Of Offer
                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('addSyndrome')}}">add Syndrome</a>
            </h3>
            <div class="p-2 table-one">

                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">name_ar</th>
                            <th scope="col">name_en</th>
                            <th scope="col">presente</th>
                            <th scope="col">end date</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patient->patient->patientSyndromes as $Syndrome)
                            <tr id="{{$Syndrome->id}}">
                                <td>
                                    {{$Syndrome->name_ar}}
                                </td>
                                <td>
                                    {{$Syndrome->name_en}}
                                </td>
                                <td>
                                    {{$Syndrome->description_ar}}
                                </td>
                                <td>
                                    {{$Syndrome->description_en}}
                                </td>


                                <td>
                            <span class="badge badge-red delete" Syndromes-id="{{$Syndrome->id}}">
			                    delete
		                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>


        </div>



@endsection

@section('scriptJs')
    <script type="text/javascript">
        // File Upload
        //

        $(document).ready(function () {

            $('.delete').click(function () {
                let educationId = $(this).attr('Syndromes-id');
                $('#'+educationId).hide();
                //removeOffer
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax(
                    {
                        url: "{{ route('deleteSyndromes') }}",
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
