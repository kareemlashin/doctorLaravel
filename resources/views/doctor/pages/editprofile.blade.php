@extends('doctor.layout.layout')
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

    <div class="right-panel">
        <div class="content-container">
            <div class="outer-container">

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
                                    @if($doctor->doctorprofile->profile)
                                        <div id="imagePreview" class="overflow-hidden"
                                             style="background-image: url({{asset($doctor->doctorprofile->profile)}});">
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
                            <div class="uploader position-relative clearfix">
                                <input id="file-upload" type="file" name="header" accept="image/*"/>

                                <label for="file-upload" id="file-drag">
                                    @if($doctor->doctorprofile->header)

                                        <img id="file-image" src="{{asset($doctor->doctorprofile->header)}}"
                                             alt="Preview">

                                    @else
                                        <img id="file-image" src="#" alt="Preview" class="hidden">

                                    @endif

                                    <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Select a file or drag here</div>
                                        <div id="notimage" class="hidden">Please select an image</div>
                                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                    </div>

                                    <div id="response" class="hidden">
                                        <div id="messages"></div>
                                        <progress class="progress" id="file-progress" value="0">
                                            <span>0</span>%
                                        </progress>
                                    </div>
                                </label>
                            </div>
                            <!---->

                            <div class="error error-header"></div>

                            <!--form-->
                            <div class="row clearfix">


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Username*</label>
                                    <input type="text" name="name" value="{{$doctor->name}}" placeholder="Username*">
                                    <div>
                                        <div class="error error-name"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>email </label>
                                    <input type="email" name="email" value="{{$doctor->email}}"
                                           placeholder="Enter your email">
                                    <div>
                                        <div class="error error-email"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label> phone</label>
                                    <input type="tel" name="phone" value="{{$doctor->doctorprofile->phone}}"
                                           placeholder="Enter your phone">
                                    <div>
                                        <div class="error error-phone"></div>

                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>price</label>
                                    <input type="number" name="price" value="{{$doctor->doctorprofile->price}}"
                                           placeholder="price">
                                    <div>
                                        <div class="error error-price"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>birthday </label>
                                    <input type="date" name="birthday" value="{{$doctor->doctorprofile->birthday}}"
                                           placeholder="birthday">
                                    <div>
                                        <div class="error error-birthday"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>website</label>
                                    <input type="url" name="website" value="{{$doctor->doctorprofile->website}}"
                                           placeholder="website">
                                    <div>
                                        <div class="error error-website"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label> facebook</label>
                                    <input type="url" name="facebook" value="{{$doctor->doctorprofile->facebook}}"
                                           placeholder=" facebook">
                                    <div>
                                        <div class="error error-facebook"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label> linkediin</label>
                                    <input type="url" name="linkediin" value="{{$doctor->doctorprofile->linkediin}}"
                                           placeholder=" linkediin">
                                    <div>
                                        <div class="error error-linkediin"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label> twitter</label>
                                    <input type="url" name="twitter" value="{{$doctor->doctorprofile->twitter}}"
                                           placeholder="twitter">
                                    <div>
                                        <div class="error error-twitter"></div>

                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>insgram</label>
                                    <input type="url" name="insgram" value="{{$doctor->doctorprofile->insgram}}"
                                           placeholder="insgram">
                                    <div>
                                        <div class="error error-insgram"></div>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>location</label>
                                    <select name="location_id" class="border-dark rounded">
                                        @foreach($locations as $location)
                                            <option
                                                value="{{$location->id}}" {{$doctor->doctorprofile->location_id == $location->id ? 'selected':''}} >{{$location->city_en}}</option>
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
                                                   type="radio" {{$doctor->doctorprofile->gender_id == 9 ? 'checked':''}} >
                                            <label for="male">male</label>
                                        </div>
                                        <div class="selection">
                                            <input id="female" value="10" name="gender_id"
                                                   type="radio" {{$doctor->doctorprofile->gender_id == 10 ? 'checked':''}}>
                                            <label for="female"> female</label>
                                        </div>

                                    </div>
                                    <div class="error error-gender_id w-100"></div>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="single-box">
                        <div class="title-box">
                            <h3>About Me</h3>
                        </div>
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Biography</label>
                                    <textarea name="text"  class="form-control"
                                              id="newText"
                                              rows="6"
                                              placeholder="Your description...">
                                        {{$doctor->doctorprofile->text}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="error error-text"></div>

                        </div>
                    </div>

                    <div class="text-center">
                        <button id="go" class="btn btn-rounded theme-btn-one px-5">submit</button>
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
            $('textarea').each(function(){
                    $(this).val($(this).val().trim());
                }
            );

            function ekUpload() {
                function Init() {

                    console.log("Upload Initialised");

                    var fileSelect = document.getElementById('file-upload'),
                        fileDrag = document.getElementById('file-drag'),
                        submitButton = document.getElementById('submit-button');

                    fileSelect.addEventListener('change', fileSelectHandler, false);

                    // Is XHR2 available?
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {
                        // File Drop
                        fileDrag.addEventListener('dragover', fileDragHover, false);
                        fileDrag.addEventListener('dragleave', fileDragHover, false);
                        fileDrag.addEventListener('drop', fileSelectHandler, false);
                    }
                }

                function fileDragHover(e) {
                    var fileDrag = document.getElementById('file-drag');

                    e.stopPropagation();
                    e.preventDefault();

                    fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
                }

                function fileSelectHandler(e) {
                    // Fetch FileList object
                    var files = e.target.files || e.dataTransfer.files;

                    // Cancel event and hover styling
                    fileDragHover(e);

                    // Process all File objects
                    for (var i = 0, f; f = files[i]; i++) {
                        parseFile(f);
                        uploadFile(f);
                    }
                }

                // Output
                function output(msg) {
                    // Response
                    var m = document.getElementById('messages');
                    m.innerHTML = msg;
                }

                function parseFile(file) {

                    console.log(file.name);
                    output(
                        '<strong>' + encodeURI(file.name) + '</strong>'
                    );

                    // var fileType = file.type;
                    // console.log(fileType);
                    var imageName = file.name;

                    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
                    if (isGood) {
                        document.getElementById('start').classList.add("hidden");
                        document.getElementById('response').classList.remove("hidden");
                        document.getElementById('notimage').classList.add("hidden");
                        // Thumbnail Preview
                        document.getElementById('file-image').classList.remove("hidden");
                        document.getElementById('file-image').src = URL.createObjectURL(file);
                    } else {
                        document.getElementById('file-image').classList.add("hidden");
                        document.getElementById('notimage').classList.remove("hidden");
                        document.getElementById('start').classList.remove("hidden");
                        document.getElementById('response').classList.add("hidden");
                        document.getElementById("file-upload-form").reset();
                    }
                }

                function setProgressMaxValue(e) {
                    var pBar = document.getElementById('file-progress');

                    if (e.lengthComputable) {
                        pBar.max = e.total;
                    }
                }

                function updateFileProgress(e) {
                    var pBar = document.getElementById('file-progress');

                    if (e.lengthComputable) {
                        pBar.value = e.loaded;
                    }
                }

                function uploadFile(file) {

                    var xhr = new XMLHttpRequest(),
                        fileInput = document.getElementById('class-roster-file'),
                        pBar = document.getElementById('file-progress'),
                        fileSizeLimit = 1024; // In MB
                    if (xhr.upload) {
                        // Check if file is less than x MB
                        if (file.size <= fileSizeLimit * 1024 * 1024) {
                            // Progress bar
                            pBar.style.display = 'inline';
                            xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
                            xhr.upload.addEventListener('progress', updateFileProgress, false);

                            // File received / failed
                            xhr.onreadystatechange = function (e) {
                                if (xhr.readyState == 4) {
                                    // Everything is good!

                                    // progress.className = (xhr.status == 200 ? "success" : "failure");
                                    // document.location.reload(true);
                                }
                            };

                            // Start upload
                            xhr.open('POST', document.getElementById('file-upload-form').action, true);
                            xhr.setRequestHeader('X-File-Name', file.name);
                            xhr.setRequestHeader('X-File-Size', file.size);
                            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
                            xhr.send(file);
                        } else {
                            output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
                        }
                    }
                }

                // Check for the various File API support.
                if (window.File && window.FileList && window.FileReader) {
                    Init();
                } else {
                    document.getElementById('file-drag').style.display = 'none';
                }
            }
            ekUpload();

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
                        url: "{{ route('customProfile') }}",
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
