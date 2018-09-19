@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="title">
                        API List
                    </div>

                    <div class="left-button">
                        <a href=" {{ route('feed.import') }}" class="btn">Import</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session()->has('location_count'))
                    <div class="alert alert-success" role="alert">
                        Locations added: {{ session('location_count') }}
                    </div>
                    @endif
                    @if(session()->has('attraction_count'))
                    <div class="alert alert-success" role="alert">
                        Attractions added: {{ session('attraction_count') }}
                    </div>
                    @endif

                    <div id="app">

                        <table class="table">

                            <thead>
                                <th>Location</th>
                                <th>Feed URL</th>
                            </thead>

                            <tbody>

                                @foreach($apifeed as $feed)

                                <tr>
                                    <td>{{ $feed->name }}</td>
                                    <td>{{ $feed->feed_url }}</td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
