@extends('layouts.home')

@section('content')
<style>
    .scrollable-container {
        overflow-x: auto;
        max-height: 300px;
        width:  50%;
    }

    .time-container {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
    }
</style>

<div class="scrollable-container">

    <div class="row">
        @foreach($appointments as $appointment)
        <div class="col 1">
            <h5 class="center">
                {{$appointment['date']}}
            </h5>
            <h5 class="center">
                <b>{{$appointment['day_name']}}</b>
            </h5>
            @if(!$appointment['off'])
            <div class="time-container">
                @foreach($appointment['business_hours'] as $time)
                @if (!in_array($time, $appointment['reserved_hours']))
                <form action="{{route('reserve')}}" method="post">
                    @csrf
                    <input type="hidden" name="date" value="{{$appointment['full_date']}}">
                    <input type="hidden" name="time" value="{{$time}}">
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <input type="email" name="email" wire:model="email" placeholder="البريد الالكتروني" required="">
                        <span class="icon fa fa-envelope"></span>
                    </div>
                    <button class="waves-effect waves-light btn info darken-2" type="submit">
                        {{$time}}
                    </button>
                    <br>
                    <br>
                </form>
                @else
                <button class="waves-effect waves-light btn info darken-2" disabled>
                    {{$time}}
                </button>
                @endif
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            twelveHour:false
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
