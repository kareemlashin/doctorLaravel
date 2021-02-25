@extends('doctor.layout.layout')
@section('linkCss')
    <style>
        input, select {
            border: 2px solid #E5E7EC !important;
            width: 100% !important;
            padding: 3px !important;
            border-radius: 5px !important;
        }

    </style>
@endsection
@section('namePage')
@endsection
@section('content')

    <div class="right-panel">
        <div class="content-container">
            <div class="outer-container">


                <form class="add-listing my-profile" method="POST" id="edit_user" enctype="multipart/form-data">

                    <div class="single-box">
                        <div class="title-box">
                            <h3>Basic </h3>
                        </div>
                        <div id="success"></div>
                        <div class="my-2 mx-4">
                            <h3 class="pt-3 mx-3 clearfix">
                                edit experience
                                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right"
                                   href="{{route('tableAllExperience')}}">table experience</a>

                            </h3>
                        </div>
                        @csrf
                        <div class="row mx-3">
                            <input name="id" value="{{$experience->id}}" type="hidden">
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>name arabic </label>
                                <input type="text" name="name_ar" value="{{$experience->name_ar}}"
                                       placeholder="name arabic">
                                <div>
                                    <div class="error error-name_ar"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>name english </label>
                                <input type="text" name="name_en" value="{{$experience->name_en}}"
                                       placeholder="name english">
                                <div>
                                    <div class="error error-name_en"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6  form-group">
                                <label>description english </label>
                                <input type="text" name="description_en" value="{{$experience->description_en}}"
                                       placeholder="description english">
                                <div>
                                    <div class="error error-description_en"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>description arabic </label>
                                <input type="text" name="description_ar" value="{{$experience->description_ar}}"
                                       placeholder="description arabic">
                                <div>
                                    <div class="error error-description_ar"></div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6  form-group">
                                <label>start date </label>
                                <input type="date" name="start_date" value="{{$experience->start_date}}"
                                       placeholder="start_date">
                                <div>
                                    <div class="error error-start_date"></div>

                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6  form-group">
                                <label> end date</label>
                                <input type="date" name="end_date" value="{{$experience->end_date}}" placeholder="">
                                <div>
                                    <div class="error error-end_date"></div>

                                </div>
                            </div>

                        </div>
                        <div class="text-center my-3">
                            <button id="go" class="btn btn-rounded theme-btn-one px-5">submit</button>
                        </div>

                    </div>

                </form>


            </div>
        </div>
    </div>


@endsection

@section('scriptJs')
    <script type="text/javascript">
        // File Upload
        //
        $(document).ready(function () {


            $('#edit_user').on('submit', function (e) {
                e.preventDefault();
            })

            $('button').on('click', function (e) {
                $(".error").html('');
                $("#success").html('');
                $("#go").attr('disabled', 'true');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var inputData = new FormData($('#edit_user')[0]);
                $.ajax(
                    {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        enctype: 'multipart/form-data',
                        url: "{{ route('updateExperience') }}",
                        data: inputData,
                        success: function (data) {
                            $("#go").removeAttr('disabled');
                            $("#success").html('');
                            $(".error").html('');
                            $("#success").append(`
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                         ${data.success}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          `);
                        },
                        error: function (error) {
                            $("#go").removeAttr('disabled');
                            $(".error").html('');
                            let err = error.responseJSON;
                            let msgdata = err.message;
                            for (const prop in msgdata) {
                                $(".error-" + prop).append(`
                                <div class="alert alert-danger alert-dismissible fade show w-100"  role="alert">
                                     ${msgdata[prop]}
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>`);
                            }

                        }
                    });
            });
        })
    </script>
@endsection

@section('page')
@endsection

@section('pageAll')
@endsection
