@extends('doctor.layout.layout')
@section('linkCss')
    <style>

        .checkbox-buttons-container input {
            position: absolute;
            left: -100vw; /* don't hide the input but move it out of view instead for better accessibility   */
        }

        .checkbox-buttons-container label {
            padding: 8px 32px;
            border: 2px solid #0060ad;
            border-radius: 5px;
            color: #0060ad;
            display: inline-block;
            position: relative;
        }

        .checkbox-buttons-container label:not(:last-child) {
            margin-right: 16px;
        }

        .checkbox-buttons-container label:hover {
            cursor: pointer;
            opacity: 0.7;
        }

        .checkbox-buttons-container input:checked + label {
            background-color: #0060ad;
            color: #fff;
        }

        .checkbox-buttons-container input:checked + label::after {
            width: 16px;
            height: 16px;
            padding: 4px;
            border: 2px solid #e9e9e9;
            border-radius: 50%;
            background: #059f00;
            content: "✔";
            font-size: 12px;
            color: #fff;
            position: absolute;
            top: -16px;
            right: -16px;
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
                            <h3>choose specialties</h3>
                        </div>
                        @csrf
                        <div class="checkbox-buttons-container mx-3">
                            @foreach($title as $titles)

                                <span class="m-1 d-inline-block">
                            <input type="checkbox" id="{{$titles->name_en}}" value="{{$titles->id}}"
                                   @foreach($specDoc as $specDo)
                                   {{ $specDo->title_id==$titles->id ? 'checked':''}}
                                   @endforeach
                                   name="title_id[]">
                            <label for="{{$titles->name_en}}">{{$titles->name_en}}
                            </label>
                                </span>
                            @endforeach
                                <div class="error error-title_id"></div>

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
                        url: "{{ route('addtitle') }}",
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
