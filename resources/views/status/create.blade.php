@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
            
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-warning" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                        <form method="POST" action="{{route('status.store')}}">
                            <div class="form-group">
                                <label for="title">Status Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                           
                            <button type="submit" class = "btn btn-primary">Save status</button>
                            <button type="button" class = "btn btn-secondary">Cancel status</button>

                            @csrf
                        </form>
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
