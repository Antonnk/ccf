@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <projects :init-projects="{{ json_encode($projects) }}"></projects>
        </div>
    </div>
</div>
@endsection
