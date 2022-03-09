@extends('layouts.master')
@section('content')
    <classes
        :classes="{{json_encode($classes)}}"
        :name="{{json_encode($teacherName)}}"
    ></classes>
@endsection
