@extends('layouts.app')

@section('content')

    <h4>Hello profile~~~~~~~</h4>

    <!-- Current Basics -->
    @if (count($basics) > 0)
        <div>
            @foreach ($basics as $basic)
                <span>{{ $basic->gender }}</span>
                <span>{{ $basic->city }}</span>
                <span>{{ $basic->birth_year }}</span>
            @endforeach
        </div>
    @endif

    <form action="/basic/create" method="POST">
        <input type="text" name="gender"/>
        <input type="text" name="city"/>
        <input type="text" name="birth_year"/>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i>Modify
        </button>
    </form>

@endsection
