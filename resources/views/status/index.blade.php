@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Statuses list</div>

                <div class="card-body">
                    @if (session('success-message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success-message') }}
                        </div>
                    @endif

                    @if($status_collection->count() > 0)
                        @foreach($status_collection as $status)
                        <div class="card">
                            <div class="card-header">
                                {{$status->title}}
                            </div>
                            @if($status->statusOfNote()->count() > 0 )
                                @foreach($status->statusOfNote as $noteWithStatus)
                                    <div class="card-body">
                                        <h5 class="card-title">{{$noteWithStatus->title}}</h5>
                                        <p class="card-text">{{$noteWithStatus->note}}</p>
                                    </div>
                                @endforeach 

                                @else
                                    <div class="card-body">
                                        <p class="card-text">No notes with such status</p>
                                        <form action="{{route('status.destroy',$status)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                         

                                    </div>
                            @endif
                        </div>
                        @endforeach   
                    @else
                    <p>No statuses were created</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#summernote').summernote();
    });
</script>
@endsection
