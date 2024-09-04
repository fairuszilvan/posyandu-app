@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="marquee-container" style="width: 100%; overflow: hidden; white-space: nowrap;">
            <div class="marquee-text" style="font-size: 40px; display: inline-block; padding-left: 100%; animation: marquee 3s linear infinite;">
                Masih dalam pengembangan
            </div>
        </div>
    </div>

    <style>
        @keyframes marquee {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }
    </style>
@endsection
