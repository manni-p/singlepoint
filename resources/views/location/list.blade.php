@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="title">
                        Locations
                    </div>

                    <div class="left-button">
                        <a href=" {{ route('location.refresh') }}" class="btn">Refresh Cache</a>
                    </div>

                </div>

                <div class="card-body">
                    @if(session()->has('refresh'))
                    <div class="alert alert-success" role="alert">
                        Cache has been refreshed.
                    </div>
                    @endif
                    <div id="app">

                        <table class="table">

                            <thead>
                                <th>Location</th>
                                <th>Attractions</th>
                                <th>Active</th>
                            </thead>

                            <tbody>

                                @foreach($locationList as $location)

                                <tr>
                                    <td>{{ $location->name }}</td>
                                    <td>
                                        <a href="{{ route('location.attractions',$location->id) }}">View</a>
                                    </td>
                                    <td>
                                        <input class="tgl tgl-ios toggle-master" id="{{ $location->id }}" data-model="Locations" data-url="{{ url('/toggle') }}" data-type="master_active" data-id="{{ $location->id }}" type="checkbox" @if($location->active == 1) checked @endif>
                                        <label class="tgl-btn" for="{{ $location->id }}"></label>
                                    </td>
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
