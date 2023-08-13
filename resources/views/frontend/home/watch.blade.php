@extends('frontend.layout.Master')
<x-frontend.header/>
@section('content')
    <div class="watch d-flex justify-content-center">
        <div class="embed-responsive embed-responsive-16by9 py-5">
            <iframe class="embed-responsive-item"
            src="{{$dataEpisodes[0]['links']}}"
            allowfullscreen width="600px"></iframe>
            <div>
                <h5 class="text-white">Tập phim</h5>
                <div class="watch-item">
                @foreach($dataAllEpisodes as $allEpisodes)
                    <a data="{{$allEpisodes->id}}" class=" p-1  {{ $dataEpisodes[0]['id'] == $allEpisodes->id ? 'bg-primary' : 'bg-secondary' }}" href="{{url('watch/'.$allEpisodes->id)}}">{{$allEpisodes->episodes}}</a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
