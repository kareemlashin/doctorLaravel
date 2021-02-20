@extends('doctor.layout.layout')
@section('linkCss')
    <link rel="stylesheet" href="{{asset('css/jquery.tagselect.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">

    <style>
        input, select {
            border: 2px solid #E5E7EC !important;
            width: 100% !important;
            padding: 3px !important;
            border-radius: 5px !important;
        }
        .qtagselect__container{
            width: 100% !important;
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
                            <h3>edit post
                                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right" href="{{route('tableAllPosts')}}">table Posts </a>

                            </h3>
                        </div>
                        @csrf
                        <div class="row mx-3">
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>tittle arabic</label>
                                <input type="text" name="tittle_ar" value="{{$post->tittle_ar}}" placeholder="tittle arabic">
                                <div>
                                    <div class="error error-tittle_ar"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>title english</label>
                                <input type="text" name="title_en" value="{{$post->title_en}}" placeholder="title english">
                                <div>
                                    <div class="error error-title_en"></div>
                                </div>
                            </div>



                            <div class="col-lg-6 col-md-6  form-group">
                                <label>description english</label>
                                <input type="text" name="description_en" value="{{$post->description_en}}" placeholder="description">
                                <div>
                                    <div class="error error-description_en"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6  form-group">
                                <label>description arabic</label>
                                <input type="text" name="description_ar" value="{{$post->description_ar}}" placeholder="description">
                                <div>
                                    <div class="error error-description_ar"></div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>tags</label>
                                <div class="qtagselect w-100">
                                    <select class="qtagselect__select w-100" multiple name="tag[]">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}" class="ispurple"
                                            @foreach($post->postTags as $postTags)
                                                {{$postTags->id == $tag->id ? 'selected':'' }}
                                                @endforeach
                                            >{{$tag->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <div class="error error-tag"></div>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-11 mx-auto col-md-11">
                            <div class="uploader position-relative clearfix ">
                                <input id="file-upload" type="file" name="photo" accept="image/*"/>

                                <label for="file-upload" id="file-drag">

                                    <img id="file-image" src="{{asset($post->photo)}}" alt="Preview" class="{{$post->photo?'':'hidden'}} ">


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
                            <div>
                                <div class="error error-photo"></div>

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
    <script src="{{asset('js/jquery.tagselect.js')}}"></script>
    <script type="text/javascript">
        // File Upload
        //
        $(document).ready(function () {
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

            $('.qtagselect__select').tagselect({

                // additional class(es)
                'class': '',

                // placeholder
                'placeholder': 'select an option',

                // additional class(es) for the dropdown
                'dropClass': '',

                // shows the footer in the dropdown
                'dropFooter': true,

                // is opened on page load
                'isOpen': false,

                // maximum number of tags allowed to select
                'maxTag': 20,

                // parent container
                'tagParent': 'qmain',

                // error message
                'tagMessage': 'Up to 20 tags!',

                // auto hides after this timeout
                'tagMessageHide': '3000',

                // custom styles for the error message
                'tagMessageStyle': ''

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
                        url: "{{ route('updatePost') }}",
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
