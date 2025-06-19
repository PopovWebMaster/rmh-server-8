@extends('layouts.layout')

@section('link_css')
    <link href= {{ $css_air_application }} rel="stylesheet">
@endsection

@section('content')
    <div id = "app"></div>
@endsection



@section('script_js')
    <script type="text/javascript" src={{ $js_air_application }}></script>
@endsection 