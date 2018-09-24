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
                                <th>-</th>
                            </thead>

                            <tbody>

                                @foreach($attractionList as $attraction)

                                <tr data-id="{{ $attraction->id }}">
                                    <td>{{ $attraction->name }}</td>
                                    <td>
                                        @if($attraction->category)
                                        {{ $attraction->category }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($attraction->address)
                                        {{ $attraction->address }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        <input class="tgl tgl-ios toggle-master" id="{{ $attraction->id }}" data-model="Attractions" data-url="{{ url('/toggle') }}" data-type="master_active" data-id="{{ $attraction->id }}" type="checkbox" @if($attraction->active == 1) checked @endif>
                                        <label class="tgl-btn" for="{{ $attraction->id }}"></label>
                                    </td>
                                    <td>
                                        <div class="btn red delete" data-id="{{ $attraction->id }}" data-name="{{ $attraction->name }}" data-toggle="modal" data-target="#deleteModal">
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
        <p>Are you sure you want to delete this attraction?</p>
    </div>
    <div class="modal-footer">
        <button type="button" data-id="" data-delete="{{ url('/delete') }}" data-model="Attractions" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

</div>
</div>

@endsection
