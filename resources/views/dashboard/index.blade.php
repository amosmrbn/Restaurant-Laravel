@extends('layouts.main')
@section('container')
<h1>Selamat Datang {{ auth()->user()->name }} di RestauranQ</h1>
@endsection