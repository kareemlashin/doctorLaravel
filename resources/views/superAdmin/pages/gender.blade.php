@extends('owner.layout.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">

@endsection

@section('content')
    <div class="bg-white rounded p-5 position-relative clearfix my-5">
        <div id="success" class="error"></div>

        <div id="error-exists" class="error"></div>

        <form method="POST" id="edit_user" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gender_en">gender english</label>
                <input type="text" class="form-control" id="gender_en" name="gender_en"
                       placeholder="Enter gender arabic">
            </div>
            <div id="error-gender_en" class="error"></div>

            <div class="form-group">
                <label for="gender_ar">gender arabic</label>
                <input type="text" class="form-control" id="gender_ar" name="gender_ar"
                       placeholder="Enter gender english">
            </div>
            <div id="error-gender_ar" class="error"></div>


            <div class="uploader position-relative clearfix">
                <input id="file-upload" type="file" name="photo" accept="image/*"/>

                <label for="file-upload" id="file-drag">
                    <img id="file-image" src="#" alt="Preview" class="hidden">
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

            <div id="error-photo" class="error"></div>
            <div class="text-center">
                <button type="button" id="go" class="btn btn-secondary">Secondary</button>

            </div>

        </form>
    </div>

@endsection
@section('script')
@endsection
@section('scriptjs')
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

            $('button').on('click', function (e) {
                $(".error").html('');
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
                        url: "{{ route('AddNewGender') }}",
                        data: inputData,
                        success: function (data) {
                            $("#go").removeAttr('disabled');
                            $("#success").html('');
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
                                $("#error-" + prop).append(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
