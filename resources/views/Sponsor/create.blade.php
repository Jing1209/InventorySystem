@extends('layouts.app')
@section('title', 'Sponsor')
@section('content')
<div class="bg-light">
    <div class="container d-flex flex-row align-items-end justify-content-center mb-3 p-3 bg-light">
        <div class="pull-right" style="margin-right: -70px">
            <a class="btn btn-primary" href="{{ route('sponsor.index') }}"> Back</a>
        </div>
        <div>
            <div>
                <img src="{{ URL('images/pic1.jpg') }}" alt="" class="img-thumbnail" style="max-height: 60%">
            </div>
           
            <div class="d-flex justify-content-center mt-3">
                <h2>Add New Sponsor</h2>
            </div>
            <div class="">
                @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
                @endif
                <form action="{{ route('sponsor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Building Title</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success pull-right">Add</button> 
                        </div>
                         
                    </div>
                     
                </form>
               
            </div>
            
        </div>
        
    </div>
        
        
        

    
    
</div>

@endsection