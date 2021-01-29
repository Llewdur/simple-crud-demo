@extends('layouts.app')

@section('content')
    @include('interests/includes/dataTable')
    @include('interests/includes/addModal')
    @include('interests/includes/editModal')
@endsection

@section('footer-scripts')
    <script type="text/javascript" src="js/generic.js"></script>
    <script type="text/javascript" src="js/interests.js"></script>
@endsection
