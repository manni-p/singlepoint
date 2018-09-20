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
                                <th>-</th>
                            </thead>

                            <tbody>

                                @foreach($locationList as $location)

                                <tr data-id="{{ $location->id }}">
                                    <td>{{ $location->name }}</td>
                                    <td>
                                        <a href="{{ route('location.attractions',$location->id) }}">View</a>
                                    </td>
                                    <td>
                                        <input class="tgl tgl-ios toggle-master" id="{{ $location->id }}" data-model="Locations" data-url="{{ url('/toggle') }}" data-type="master_active" data-id="{{ $location->id }}" type="checkbox" @if($location->active == 1) checked @endif>
                                        <label class="tgl-btn" for="{{ $location->id }}"></label>
                                    </td>
                                    <td>
                                        <div class="btn red delete" data-id="{{ $location->id }}" data-name="{{ $location->name }}" data-toggle="modal" data-target="#deleteModal">
                                            Delete
                                        </div>
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

<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete this location?</p>
    </div>
    <div class="modal-footer">
        <button type="button" data-id="" data-delete="{{ url('/delete') }}" data-model="Locations" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

</div>
</div>

@endsection
