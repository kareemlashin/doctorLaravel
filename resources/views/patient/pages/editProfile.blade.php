@extends('patient.layout.layout')
@section('linkCss')
    <!---->

    <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">
    <!---->

    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #fff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

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


                <form class="add-listing my-profile" method="POST" id="edit_user" enctype="multipart/form-data">

                    <div class="single-box">
                        <div class="title-box">
                            <h3>Basic Information</h3>
                        </div>
                        <div id="success"></div>

                        @csrf

                        <div class="inner-box">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" name="profile" accept=".png, .jpg, .jpeg"/>
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    @if($patient->patient->profile)
                                        <div id="imagePreview" class="overflow-hidden"
                                             style="background-image: url({{asset($patient->patient->profile)}});">
                                        </div>
                                    @else
                                        <div id="imagePreview" class="overflow-hidden"
                                             style="background-image: url({{asset('upload/image/gender_1613020276.png')}});">
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="error error-profile"></div>
                            <!---->


                            <!--form-->
                            <div class="row clearfix">


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Username*</label>
                                    <input type="text" name="name" value="{{$patient->name}}" placeholder="Username*">
                                    <div>
                                        <div class="error error-name"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>email </label>
                                    <input type="email" name="email" value="{{$patient->email}}"
                                           placeholder="Enter your email">
                                    <div>
                                        <div class="error error-email"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label> phone</label>
                                    <input type="tel" name="phone" value="{{$patient->patient->phone}}"
                                           placeholder="Enter your phone">
                                    <div>
                                        <div class="error error-phone"></div>

                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>birthday </label>
                                    <input type="date" name="birthday" value="{{$patient->patient->birthday}}"
                                           placeholder="birthday">
                                    <div>
                                        <div class="error error-birthday"></div>

                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>location</label>
                                    <select name="location_id" class="border-dark rounded">
                                        @foreach($locations as $location)
                                            <option
                                                value="{{$location->id}}" {{$patient->patient->location_id == $location->id ? 'selected':''}} >{{$location->city_en}}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        <div class="error error-location_id w-100"></div>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>gender</label>
                                    <div class="hungry">

                                        <div class="selection">
                                            <input id="male" value="9" name="gender_id"
                                                   type="radio" {{$patient->patient->gender_id == 9 ? 'checked':''}} >
                                            <label for="male">male</label>
                                        </div>
                                        <div class="selection">
                                            <input id="female" value="10" name="gender_id"
                                                   type="radio" {{$patient->patient->gender_id == 10 ? 'checked':''}}>
                                            <label for="female"> female</label>
                                        </div>

                                    </div>
                                    <div class="error error-gender_id w-100"></div>

                                </div>


                            </div>

                        </div>

                    </div>


                    <div class="text-center">
                        <button id="go" class="btn btn-rounded theme-btn-one px-5">submit</button>
                    </div>
                </form>


@endsection

@section('scriptJs')
    <script type="text/javascript">
        // File Upload
        //
        $(document).ready(function () {


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageUpload").change(function () {
                readURL(this);
            });

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
                        url: "{{ route('updateProfile') }}",
                        data: inputData,
                        success: function (data) {
                            location.reload();

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

