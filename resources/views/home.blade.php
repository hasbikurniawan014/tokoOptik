@extends('layouts.app')

@section('content')
@can('karyawan')
    @include('dashboard.karyawan.dashboard')
@endcan
@can('ketoko')
    @include('dashboard.kepToko.dashboard')
@endcan
@endsection
