@extends('layouts.app')

@push('styles')
    <style type="text/css">
        @keyframes rotate {
            from{
                transform: rotate(0deg);
            }
            to{
                transform: rotate(360deg);
            }
        }


        .refresh{
            animation: rotate 1.5s linear infinite;
        }

    </style>

@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Game</div>

                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('img/circle.png')}}" id="circle" height="250" width="250" alt="" class="">
{{--                            遊戲開始會加上class refresh--}}
                            <p id="winner" class="display-1 d-none text-primary"></p>
                        </div>

                        <hr>

                        <div class="text-center">
                            <label for="bet" class="font-weight-bold h5">賭起來!</label>
                            <select id="bet" class="custom-select col-auto">
                                <option selected>Not in</option>
                                @foreach(range(1,12) as $number)
                                    <option>{{ $number }}</option>
                                @endforeach
                            </select>

                            <hr>

                            <p class="font-weight-bold h5">剩餘時間</p>
                            <p id="timer" class="h5 text-danger">等待開始...</p>

                            <hr>

                            <p id="result" class="h1"></p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>

    </script>
@endpush