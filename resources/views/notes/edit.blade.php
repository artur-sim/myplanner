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
                                {{error}}
                            </div>
                        @endforeach
                    @endif

                        <form method="POST" action="{{route('notes.update',[$note])}}">
                            <div class="form-group">
                                <label for="title">Plan Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$note->title}}">
                            </div>
                            <div class="form-group">
                                <label for="priority">Select Priority</label>
                            
                                <select class="form-control" id="priority" name= "priority">
                                @foreach($priority as $priorVal)
                                        <option value="{{$priorVal}}" @if ($priorVal  === $note->priority) selected @endif >
                                             {{$priorVal}}
                                        </option>
                                @endforeach
                                  
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="note">Notes</label>
                                <textarea class="form-control" id="summernote" rows="3" name="note">{{$note->note}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <select class="form-control" id="status_id" name= "status_id">
                               
                                    @foreach($status_collection as $status)
                                        <option value="{{$status->id}}" @if($note->status_id == $status->id) selected @endif >
                                             {{$status->title}}
                                        </option>
                                    @endforeach
                                
                            </div>
                            @csrf

                            <button type="submit" class = "mt-3 btn btn-primary">Save note</button>
                            <a   href="{{route('notes.index')}}" class = " mt-3  btn btn-secondary">Cancel note</a>

                          
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
