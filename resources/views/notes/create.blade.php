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
 
                        <form method="POST" action="{{route('notes.store')}}">
                            <div class="form-group">
                                <label for="title">Plan Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" >
                            </div>
                            <div class="form-group">
                                <label for="priority">Select Priority</label>
                                
                                <select class="form-control" id="priority" name= "priority">

                                    @foreach($priority as $priorVal)
                                            <option value="{{$priorVal}}" @if($priorVal == old('priority')) selected @endif  >
                                                {{$priorVal}}
                                            </option>
                                    @endforeach
                           
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="note">Example textarea</label>
                                <textarea class="form-control" id="summernote" rows="3" name="note"  > {{old('note')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <select class="form-control" id="status_id" name= "status_id">
                                @if($status_collection->count() > 0)
                                    @foreach($status_collection as $status)
                                        <option value="{{$status->id}}" >{{$status->title}}</option>
                                    @endforeach
                                @else
                                    <option value="nostatus">No statuses created, please create one</option>
                                    @endif
                                </select>
                            </div>
                            
                            <button type="submit" class = "btn btn-primary">Save note</button>
                            <a  href="{{route('notes.index')}}"  class = "btn btn-secondary">Cancel note</a>

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
