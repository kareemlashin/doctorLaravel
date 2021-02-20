@extends('doctor.layout.layout')
@section('linkCss')
    <link rel="stylesheet" href="{{asset('css/jquery.tagselect.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('map/leaflet.css')}}">

    <style>
        input, select {
            border: 2px solid #E5E7EC !important;
            width: 100% !important;
            padding: 3px !important;
            border-radius: 5px !important;
        }

        .qtagselect__container {
            width: 100% !important;
        }

        html * {
            box-sizing: border-box;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #45C1B6;
            border-color: #45C1B6;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #45C1B6;
            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
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
                            <h3>Add clinic
                                <a class="btn btn-rounded theme-btn-one px-3 py-1  float-right"
                                   href="{{route('tableAllPosts')}}">table clinic </a>

                            </h3>
                        </div>
                        @csrf
                        <div class="row mx-3">
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>tittle arabic</label>
                                <input type="text" name="tittle_ar" placeholder="tittle arabic">
                                <div>
                                    <div class="error error-tittle_ar"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>title english</label>
                                <input type="text" name="tittle_en" placeholder="title english">
                                <div>
                                    <div class="error error-tittle_en"></div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6  form-group">
                                <label>description english</label>
                                <input type="text" name="description_en" placeholder="description">
                                <div>
                                    <div class="error error-description_en"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6  form-group">
                                <label>address </label>
                                <input type="text" name="address" placeholder="address">
                                <div>
                                    <div class="error error-address"></div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  form-group">
                                <label>phone </label>
                                <input type="tel" name="phone" placeholder="phone">
                                <div>
                                    <div class="error error-phone"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6  form-group">
                                <label>description arabic</label>
                                <input type="text" name="description_ar" placeholder="description">
                                <div>
                                    <div class="error error-description_ar"></div>

                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="upload__box w-100">
                                    <div class="upload__btn-box w-100">
                                        <label class="upload__btn w-100">
                                            gallery clinic
                                            <input type="file" multiple="" name='image[]' accept="image/*" data-max_length="20"
                                                   class="upload__inputfile">
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                </div>
                                <div>
                                    <div class="error error-image"></div>

                                </div>
                            </div>

                            <div class="col-md-12 ">

                                <div id="map">


                                </div>
                                <div>
                                        <input type="hidden" name="lat" id="lat"></div>
                                    <div>
                                        <input type="hidden" name="lng" id="lng">
                                    </div>
                                </div>

                                <div class="text-center my-3">
                                    <button id="go" class="btn btn-rounded theme-btn-one px-5">submit</button>
                                </div>

                            </div>
                    </div>
                </form>


            </div>
        </div>
    </div>


@endsection

@section('scriptJs')
    <script src="{{asset('js/jquery.tagselect.js')}}"></script>
    <script src="{{asset('map/leaflet.js')}}"></script>
    <script src="{{asset('map/d3.v3.min.js')}}"></script>
    <script src="{{asset('map/leaflet.markercluster.js')}}"></script>
    <script type="text/javascript">
        // File Upload
        //
        $(document).ready(function () {
            var map;
            var pin;
            var tilesURL = 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2FyZWVtbGFzaGluIiwiYSI6ImNrY3VqaWdxNzB6eW0yem80Y3NnNmt3MG8ifQ.ZsSUr0fdNAYxM0NEg5A5dA';
            var mapAttrib = '';
            var myIcon = L.icon({
                iconUrl: 'https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|2ecc71&chf=a,s,ee00FFFF', // pull out values as desired from the feature feature.properties.style.externalGraphic.
                iconSize: [20, 35],
            });

// add map container
            $('#map').prepend('<div id="map" style="height:70vh;width:100%;"></div>');
            MapCreate();

            function MapCreate() {
                // create map instance
                if (!(typeof map == "object")) {
                    map = L.map('map', {
                        center: [30.06175154622878, 31.18369398702622],
                        zoom: 5
                    });
                } else {
                    map.setZoom(3).panTo([30.06175154622878, 31.18369398702622]);
                }
                // create the tile layer with correct attribution
                L.tileLayer(tilesURL, {
                    attribution: mapAttrib,
                    maxZoom: 19
                }).addTo(map);
            }
 /*           pin = L.marker({lat:30.937499999999996,lng:30.937499999999996},{icon: myIcon}, {riseOnHover: true, draggable: true});
            pin.addTo(map);
*/
            map.on('click', function (ev) {

                $('#lat').val(ev.latlng.lat);
                $('#lng').val(ev.latlng.lng);
                if (typeof pin == "object") {
                    pin.setLatLng(ev.latlng);
                } else {
                    pin = L.marker(ev.latlng,{icon: myIcon}, {riseOnHover: true, draggable: true});
                    pin.addTo(map);
                    pin.on('drag', function (ev) {
                        $('#lat').val(ev.latlng.lat);
                        $('#lng').val(ev.latlng.lng);
                    });
                }
            });
            ImgUpload();


            function ImgUpload() {
                var imgWrap = "";
                var imgArray = [];

                $('.upload__inputfile').each(function () {
                    $(this).on('change', function (e) {
                        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                        var maxLength = $(this).attr('data-max_length');

                        var files = e.target.files;
                        var filesArr = Array.prototype.slice.call(files);
                        var iterator = 0;
                        filesArr.forEach(function (f, index) {

                            if (!f.type.match('image.*')) {
                                return;
                            }

                            if (imgArray.length > maxLength) {
                                return false
                            } else {
                                var len = 0;
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i] !== undefined) {
                                        len++;
                                    }
                                }
                                if (len > maxLength) {
                                    return false;
                                } else {
                                    imgArray.push(f);

                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                        imgWrap.append(html);
                                        iterator++;
                                    }
                                    reader.readAsDataURL(f);
                                }
                            }
                        });
                    });
                });

                $('body').on('click', ".upload__img-close", function (e) {
                    var file = $(this).parent().data("file");
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i].name === file) {
                            imgArray.splice(i, 1);
                            break;
                        }
                    }
                    $(this).parent().parent().remove();
                });
            }

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
                        url: "{{ route('createClinic') }}",
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
