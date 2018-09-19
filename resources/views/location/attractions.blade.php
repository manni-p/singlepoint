@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="title">
                        Attractions
                    </div>

                    <div class="left-button">
                        <a href=" {{ route('location.refresh') }}" class="btn">Refresh Cache</a>
                    </div>

                </div>

                <div class="card-body">

                    <div id="app">

                        <table class="table">

                            <thead>
                                <th>Attraction</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>Active</th>
                            </thead>

                            <tbody>

                                @foreach($attractionList as $attraction)

                                <tr>
                                    <td>{{ $attraction->name }}</td>
                                    <td>{{ $attraction->category }}</td>
                                    <td>{{ $attraction->address }}</td>
                                    <td>
                                        <input class="tgl tgl-ios toggle-master" id="{{ $attraction->id }}" data-model="Attractions" data-url="/toggle" data-type="master_active" data-id="{{ $attraction->id }}" type="checkbox" @if($attraction->active == 1) checked @endif>
                                        <label class="tgl-btn" for="{{ $attraction->id }}"></label>
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
