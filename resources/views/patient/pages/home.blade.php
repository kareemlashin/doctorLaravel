@extends('patient.layout.layout')
@section('linkCss')
@endsection
@section('namePage')
@endsection
@section('content')
    <div>
        {{$patient}}


    </div>
@endsection
@section('scriptJs')
    <script>
        $(document).ready(function () {
            $('.preloader').fadeOut();
        })

    </script>
@endsection
@section('script')
@endsection

@section('page')
@endsection

@section('pageAll')
@endsection
