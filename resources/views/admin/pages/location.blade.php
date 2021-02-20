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
                <label for="country_ar">country arabic</label>
                <input type="text" class="form-control" id="country_ar" name="country_ar"
                       placeholder="Enter gender arabic">
            </div>
            <div id="error-country_ar" class="error"></div>
            <div class="form-group">
                <label for="country_en">country english</label>
                <input type="text" class="form-control" id="country_en" name="country_en"
                       placeholder="Enter gender english">
            </div>
            <div id="error-country_en" class="error"></div>

            <div class="form-group">
                <label for="city_ar"> city arabic</label>
                <input type="text" class="form-control" id="city_ar" name="city_ar"
                       placeholder="Enter gender arabic">
            </div>
            <div id="error-city_ar" class="error"></div>

            <div class="form-group">
                <label for="city_en"> city english</label>
                <input type="text" class="form-control" id="city_en" name="city_en"
                       placeholder="Enter gender english">
            </div>
            <div id="error-city_en" class="error"></div>

            <div class="form-group">
                <label for="code"> code </label>
                <input type="text" class="form-control" id="code" name="code"
                       placeholder="Enter gender english">
            </div>
            <div id="error-code" class="error"></div>
            <div class="form-group">
                <label for="code"> key </label>
                <input type="text" class="form-control" id="key" name="key"
                       placeholder="Enter gender english">
            </div>
            <div id="error-key" class="error"></div>

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
                        url: "{{ route('AddNewLocation') }}",
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
