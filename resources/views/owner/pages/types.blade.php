@extends('owner.layout.layout')
@section('css')
@endsection
@section('content')
    <div class="row mt-5 mb-2">

        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('addLocation')}}" class="btn btn-primary btn-sm float-right">
                            <i class='uil uil-export ml-1'></i> add new

                    </a>
                    <h5 class="card-title mt-0 mb-0 header-title">All location</h5>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">country arabic</th>
                                <th scope="col">country english</th>
                                <th scope="col">city arabic </th>
                                <th scope="col">city english </th>
                                <th scope="col">code</th>
                                <th scope="col">key</th>
                                <th scope="col">edit</th>
                                <th scope="col">delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locations as $location)
                            <tr class="text-center">
                                <td>{{$location->country_ar}}</td>
                                <td>{{$location->country_en}}</td>
                                <td>{{$location->city_ar}}</td>
                                <td>{{$location->city_en}}</td>
                                <td>{{$location->code}}</td>
                                <td>{{$location->key}}</td>

                                <td><span class="badge badge-soft-warning py-1">edit</span></td>
                                <td><span class="badge badge-soft-danger py-1">delete</span></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>

    </div>

    <div class="row my-2">

        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('addGender')}}" class="btn btn-primary btn-sm float-right">
                        <i class='uil uil-export ml-1'></i> add new

                    </a>
                    <h5 class="card-title mt-0 mb-0 header-title">All gender</h5>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">name arabic</th>
                                <th scope="col">name english</th>
                                <th scope="col">photo</th>
                                <th scope="col">edit</th>
                                <th scope="col">delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($genders as $gender)
                                <tr class="text-center">
                                    <td>{{$gender->name_ar}}</td>
                                    <td>{{$gender->name_en}}</td>
                                    <td><img src="{{asset($gender->photo)}}" width="50px" height="50px" class=" rounded-circle" alt="" srcset=""></td>
                                    <td><span class="badge badge-soft-warning py-1">edit</span></td>
                                    <td><span class="badge badge-soft-danger py-1">delete</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>

    </div>

    <div class="row my-2">

        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('addSpecialties')}}" class="btn btn-primary btn-sm float-right">
                        <i class='uil uil-export ml-1'></i> add new
                    </a>
                    <h5 class="card-title mt-0 mb-0 header-title">All specialties</h5>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">specialties arabic</th>
                                <th scope="col">specialties english</th>
                                <th scope="col">photo</th>
                                <th scope="col">description</th>
                                <th scope="col">edit</th>
                                <th scope="col">delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($specialtie as $specialti)
                                <tr class="text-center">
                                    <td>{{$specialti->specialties_ar}}</td>
                                    <td>{{$specialti->specialties_en}}</td>
                                    <td><img src="{{asset($specialti->photo)}}" width="50px" height="50px" class=" rounded-circle" alt="" srcset=""></td>
                                    <td>{{$specialti->description}}</td>
                                    <td><span class="badge badge-soft-warning py-1">edit</span></td>
                                    <td><span class="badge badge-soft-danger py-1">delete</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>

    </div>

@endsection
@section('script')
@endsection
@section('scriptjs')
@endsection
