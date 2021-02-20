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
                            <h3>Add experience</h3>
                        </div>
                        @csrf
                        <div id="dynamic-form">
                            <div>
                                <div class="error"></div>
                            </div>


                            <div class="row mx-3">

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>name arabic</label>
                                    <input type="text" name="name_ar[]">

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>name english</label>
                                    <input type="text" name="name_en[]">

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>description arabic</label>
                                    <input type="text" name="description_ar[]">

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>name english</label>
                                    <input type="text" name="description_en[]">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>start date</label>
                                    <input type="date" name="start_date[]">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>end date</label>
                                    <input type="date" name="end_date[]">

                                </div>

                            </div>

                        </div>
                        <div class="text-right mx-5">
                            <button id="addform" class="btn btn-rounded theme-btn-two px-5">add form</button>

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
            let count = 1;
            $("#addform").click(function () {
                $('#dynamic-form').append(`
                  <div class="row mx-3 new-form">

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>name arabic</label>
                                <input type="text" name="name_ar[]" >

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>name english</label>
                                <input type="text" name="name_en[]" >

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>description arabic</label>
                                <input type="text" name="description_ar[]" >
  </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>name english</label>
                                <input type="text" name="description_en[]" >

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>start date</label>
                                <input type="date" name="start_date[]" >

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>end date</label>
                                <input type="date" name="end_date[]" >

                            </div>
                            <button id="removeRow"  class="btn btn-rounded theme-btn-two px-5 removeForm">remove form</button>
                  </div>
               `)
                count++;
            });
            $(document).on('click', '#removeRow', function () {
                $(this).closest('.new-form').remove();
                count--;

            });


            $('#edit_user').on('submit', function (e) {
                e.preventDefault();
            })

            $('#go').on('click', function (e) {
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
                        url: "{{ route('newexperience') }}",
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
                                $(".error").append(`
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
