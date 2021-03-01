@extends('patient.layout.layout')
@section('linkCss')
    <style>
        .active {
            color: #39CABB;
        }

        select {
            border: 2px solid #eee !important;
            border-radius: 5px !important;
        }

        .clinic-block-one .inner-box .image-box img {
            width: 100%;
            border-radius: 20px;
            height: 100px;
        }

        .fa-star {
            color: #ffff00;
        }

        .tag {
            border: 2px solid rgba(57, 202, 187, 0.6);
            background-color: rgba(57, 202, 187, 0.4);
            color: #fff;
        }

        .base-color {
            color: rgb(57, 202, 187);

        }

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

        .filter span {
            padding: 3px 25px;
            border: 2px solid rgba(57, 202, 187, 0.6);
            background-color: rgba(57, 202, 187, 0.4);
            color: #fff;
            border-radius: 15px;
            cursor: pointer;
        }

        .CLEAR span {
            padding: 3px 25px;
            border: 2px solid #DC4444;
            background-color: #DC4444;
            color: #fff;
            border-radius: 15px;
            cursor: pointer;

        }

        .page {
            cursor: pointer;
        }
    </style>
@endsection
@section('namePage')
@endsection
@section('content')
    <div class="bg-white p-3 mb-2 rounded">
        <h6>by gender : </h6>
        <div class="my-2">
            @foreach($genders as $gender)
                <span class="checkbox-buttons-container">
            <input type="radio" id="{{$gender->name_en}}" name="gender" value="{{$gender->id}}">
            <label for="{{$gender->name_en}}">{{$gender->name_en}}</label>
        </span>
            @endforeach
        </div>
        <h6>by title : </h6>
        <div class="my-2">
            @foreach($titles as $title)

                <span class="checkbox-buttons-container">
            <input type="checkbox" id="{{$title->name_en}}" name="title[]" value="{{$title->id}}">
            <label for="{{$title->name_en}}">{{$title->name_en}}</label>
        </span>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6">
                <h6>by specialties : </h6>

                <select class=" border form-select" name="specialties">
                    @foreach($specialties as $specialtie)
                        <option value="{{$specialtie->id}}">{{$specialtie->specialties_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h6>by location : </h6>

                <select class=" border form-select" name="location">

                    @foreach($locations as $location)

                        <option value="{{$location->id}}">{{$location->city_ar}}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <h6>by name : </h6>
        <div class="my-2 filter">
            <span filter-by="name" value="DESC">Z-A</span>
            <span filter-by="name" value="ASC">A-Z</span>
        </div>

        <h6>by age : </h6>
        <div class="my-2 filter">
            <span filter-by="age" value="DESC">last</span>
            <span filter-by="age" value="ASC">old</span>
        </div>
        <h6>by price : </h6>
        <div class="my-2 filter">
            <span filter-by="price" value="DESC">high</span>
            <span filter-by="price" value="ASC">low</span>
        </div>

        <h6>by viewer : </h6>
        <div class="my-2 filter">
            <span filter-by="viewer" value="DESC">top</span>
            <span filter-by="viewer" value="ASC">low</span>
        </div>
        <h6>by likes : </h6>
        <div class="my-2 filter">
            <span filter-by="likes_post_count" value="DESC">big like</span>
            <span filter-by="likes_post_count" value="asc">low like</span>
        </div>
        <h6>by rate : </h6>
        <div class="my-2 filter">
            <span filter-by="rate" value="DESC">big rate</span>
            <span filter-by="rate" value="ASC">low rate</span>
        </div>
        <h6>CLEAR : </h6>
        <div class="my-2 CLEAR">
            <span> CLEAR</span>
        </div>

        <div class="w-50 mx-auto">
            <input type="text" class="w-100 rounded-pill py-2 form-control" name="" id="search">
        </div>

    </div>

    <!-- doctors-page-section -->
    <section class="clinic-section doctors-page-section pt-0 mt-0 px-0 mx-0 ">
        <div class="data row">

        </div>

        <div class="pagination-wrapper">
            <ul class="pagination pagination">

            </ul>
        </div>


    </section>
    <!-- doctors-page-section end -->

@endsection

@section('scriptJs')
    <script type="text/javascript">
        // File Upload
        //


        $(document).ready(function () {
            var searchVal = '';
            var gender = '';
            var age = '';
            var viewer = '';
            var name = '';
            var titles=[];
            var location='';
            var specialties='';
            var price='';
            var page = 1;
            var data = {
                page: page,
                gender: gender,
                age: age,
                name: name,
                viewer: viewer,
                titles:titles,
                location:location,
                specialties:specialties,
                price:price
            };
            $('select[name="location"]').change(function () {
                location =$(this).val();
                data.location=location;
                getData();

            });
            $('select[name="specialties"]').change(function () {
                specialties =$(this).val();
                data.specialties=specialties;
                getData();

            });
            $('input[type=checkbox]').change(function () {
                titles = [];
                $('input[type=checkbox]:checked').each(function () {
                    titles.push(this.value);
                });
                data.titles = titles;
                getData();
            });

            $(document).on("click", ".page", function () {
                $('.page').removeClass('current');
                $(this).addClass('current');
                let num = $(this).attr('page');
                data.page = num;
                page = num;
                getData();

            })

            $('input[type=radio]').change(function () {
                gender = $('input[type=radio]:checked').val();
                data.gender = gender;
                getData();
            });
            //
            $('.filter span').click(function () {
                let filter_by = $(this).attr('filter-by');
                let value = $(this).attr('value');
                console.log(filter_by);
                switch (filter_by) {
                    case 'age':
                        data.age = '';
                        age = value;
                        data.age = value;
                        break;
                    case 'name':
                        data.name = '';
                        name = value;
                        data.name = value;
                        break;
                    case 'viewer':
                        data.viewer = '';
                        viewer = value;
                        data.viewer = value;
                        break;
                    case 'price':
                        data.price = '';
                        price = value;
                        data.price = value;
                        break;
                    default:
                        break

                }
                getData();
            });
            $('.CLEAR span').click(function () {
                data = {
                    page: page
                };
                $("#search").val('');
                $('input:radio').attr('checked', false);
                searchVal = '';

                getData();

            })

            $(document).on("click", ".page", function () {
                $('.page').removeClass('current');
                $(this).addClass('current');
                let num = $(this).attr('page');
                data.page = num;
                getData();

            })

            function date(date_use) {
                var date = new Date(date_use); // Or your date here
                return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();

            }


            function getData() {
                $('.data').html('');
                $('.pagination').html('');

                $.ajax({  //create an ajax request to display.php
                    type: "GET",
                    url: "{{route('getDoctors')}}",
                    data: data,
                    success: function (res) {
                        let paginate = res.links;

                        let data = res.data;
                        let allData = '';
                        if (searchVal === '') {

                            for (var i in data) {

                                allData += `

                <div class="col-lg-12 col-md-12 col-sm-12 content-side">

                    <div class="wrapper list px-0">
                        <div class="clinic-list-content list-item">
                            <div class="clinic-block-one">
                                <div class="inner-box">

                                    <figure class="image-box"><img src="http://127.0.0.1:8000/${data[i].profile}" height="100%" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="name-box clearfix">
                                            <li class="name"><h3><a href="singleDoctor/${data[i].id}"> ${data[i].doctorprofile.name}</a></h3></li>
                                            <li><i class="icon-Trust-1"></i></li>
                                            <li><i class="icon-Trust-2"></i></li>
                                        </ul>

                                        <div class="designation  my-2">

                                ${(function specialtiesdoctor() {
                                    let r = ``;
                                    for (let m = 0; m < data[i].specialtiesdoctor.length; m++) {
                                        if (m === 3) {

                                            r += '<span class="border px-5 py-1 my-1 mx-1 d-inline-block rounded-pill">.....</span>';
                                            break;

                                        }
                                        r += '<span class="border px-2 py-1 my-1 mx-1 d-inline-block rounded-pill">'
                                            + data[i].specialtiesdoctor[m].specialties_en +
                                            '<img class="mx-2" height="25px" width="25px" src="http://127.0.0.1:8000/' + data[i].specialtiesdoctor[m].photo + '">' +
                                            '</span>';
                                    }
                                    return r;

                                })()}

</div>


                                        <div class="designation  my-2">

                                ${(function fun() {
                                    let r = ``;
                                    for (let z = 0; z < data[i].titlesdoctor.length; z++) {
                                        if (z === 2) {

                                            r += '<span class="border px-4 py-1 my-1 mx-1 d-inline-block rounded-pill">.....</span>';
                                            break;

                                        }
                                        r += '<span class="border px-4 py-1 mx-1 my-1 d-inline-block rounded-pill">'
                                            + data[i].titlesdoctor[z].name_en +
                                            '</span>';
                                    }
                                    return r;

                                })()}

</div>

                                        <div class="text my-2">
                                            <p>${data[i].text.substring(0, 50)}...</p>
                                        </div>
                                        <div class="location-box">
                                            <p>
<i class="far fa-eye"></i>${data[i].view}</p>
                                        </div>

                                        <div class="rating-box clearfix">
                                            <ul class="rating clearfix">
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li>(17)</li>
                                            </ul>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-map-marker-alt"></i> ${data[i].location.city_ar},${data[i].location.country_en}</p>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-mobile-alt"></i> ${data[i].phone}</p>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-venus-mars"></i> ${data[i].gender.name_en}</p>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-money-bill-wave-alt"></i> price : ${data[i].price} / H</p>
                                        </div>


                                        <div class="location-box">
                                            <p><i class="fas fa-calendar-alt"></i> birthDay : ${date(data[i].birthday)} age : (${data[i].age})</p>
                                        </div>

                                        <div class="btn-box"><a href="singleDoctor/${data[i].id}">Visit Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

`;

                            }
                        } else {
                            for (var i in data) {
                                if (data[i].doctorprofile.name.toLocaleLowerCase().includes(searchVal.toLocaleLowerCase())) {

                                    allData += `

                <div class="col-lg-12 col-md-12 col-sm-12 content-side">

                    <div class="wrapper list px-0">
                        <div class="clinic-list-content list-item">
                            <div class="clinic-block-one">
                                <div class="inner-box">

                                    <figure class="image-box"><img src="http://127.0.0.1:8000/${data[i].profile}" height="100%" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="name-box clearfix">
                                            <li class="name"><h3><a href="singleDoctor/${data[i].id}"> ${data[i].doctorprofile.name}</a></h3></li>
                                            <li><i class="icon-Trust-1"></i></li>
                                            <li><i class="icon-Trust-2"></i></li>
                                        </ul>

                                        <div class="designation  my-2">

                                ${(function specialtiesdoctor() {
                                        let r = ``;
                                        for (let m = 0; m < data[i].specialtiesdoctor.length; m++) {
                                            if (m === 3) {

                                                r += '<span class="border px-5 py-1 my-1 mx-1 d-inline-block rounded-pill">.....</span>';
                                                break;

                                            }
                                            r += '<span class="border px-2 py-1 my-1 mx-1 d-inline-block rounded-pill">'
                                                + data[i].specialtiesdoctor[m].specialties_en +
                                                '<img class="mx-2" height="25px" width="25px" src="http://127.0.0.1:8000/' + data[i].specialtiesdoctor[m].photo + '">' +
                                                '</span>';
                                        }
                                        return r;

                                    })()}

</div>


                                        <span class="designation d-inline-block my-2">

                                ${(function fun() {
                                        let r = ``;
                                        for (let z = 0; z < data[i].titlesdoctor.length; z++) {
                                            r += '<span class="border px-4 py-1 rounded-pill">'
                                                + data[i].titlesdoctor[z].name_en +
                                                '</span>';
                                        }
                                        return r;

                                    })()}

</span>

                                        <div class="text my-2">
                                            <p>${data[i].text.substring(0, 50)}...</p>
                                        </div>
                                        <div class="location-box">
                                            <p>
<i class="far fa-eye"></i>${data[i].view}</p>
                                        </div>

                                        <div class="rating-box clearfix">
                                            <ul class="rating clearfix">
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li><i class="icon-Star"></i></li>
                                                <li>(17)</li>
                                            </ul>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-map-marker-alt"></i> ${data[i].location.city_ar},${data[i].location.country_en}</p>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-mobile-alt"></i> ${data[i].phone}</p>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-venus-mars"></i> ${data[i].gender.name_en}</p>
                                        </div>
                                        <div class="location-box">
                                            <p><i class="fas fa-money-bill-wave-alt"></i> price : ${data[i].price} / H</p>
                                        </div>


                                        <div class="location-box">
                                            <p><i class="fas fa-calendar-alt"></i> birthDay : ${date(data[i].birthday)} age : (${data[i].age})</p>
                                        </div>

                                        <div class="btn-box"><a href="singleDoctor/${data[i].id}">Visit Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

`;

                                }
                            }
                        }
                        $('.data').html(allData);


                        let links = '';
                        for (var p in paginate) {
                            if (typeof paginate[p].label === 'string') {
                                links += ``;
                            } else {
                                links += `
                                <li><a class="${paginate[p].active ? 'current' : ''} page" page="${paginate[p].label}">${paginate[p].label}</a></li>
                            `;
                            }
                        }
                        $('.pagination').html(links);

                    },
                    error: function () {

                    }

                });
            }

            getData();
            $('#search').keyup(function () {
                searchVal = $(this).val();
                getData();
            })


        })
    </script>
@endsection

@section('page')
@endsection

@section('pageAll')
@endsection
