@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link disabled"  >Plan List</a>
                        </li>
                        
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sort</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('notes.show','asc')}}">Sort by status asc</a>
                                <a class="dropdown-item" href="{{route('notes.show','desc')}}">Sort by status desc</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  href="{{route('notes.show','priority')}}">Sort by priority</a>
                                </div>
                        </li>
                    </ul>

                         
                </div>

                <div class="card-body">
                    @if (session('success-message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success-message') }}
                        </div>
                    @endif

                        @if($note_collection->count() > 0)
                            @foreach($note_collection as $note)
                                <div class="card mt-2">
                                    <div class="card-header "> {{$note->title}} </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Priority: {{$note->priority}}</h5>
                                        <p class="card-text">Notes: {!!$note->note!!} </p>
                                    
                                        <form method="POST" action="{{route('notes.destroy',$note)}}">
                                        @csrf
                                            <a href="{{route('notes.edit',[$note])}}" class="btn btn-primary">Edit note</a>

                                            <button type="submit" class="btn btn-danger">Delete </button>

                                            <a href="{{route('notes.pdf',$note)}}" class="btn btn-primary">PDF</a>
                                        </form>
                                    </div>
                                    <div class="card-footer text-muted">

                                    <p> Status:  {{$note->hasStatus->title}}
                                    </p>
                                    </div>
                                </div> 
                            @endforeach 
                        @else
                            <div class="card-body">
                                <p class="card-text">No notes saved</p>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

 
@endsection
