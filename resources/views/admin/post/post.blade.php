@extends('layouts.backend.app')

@section('title', 'Create Post')

@push('css')
    
@endpush

@section('content')
    <div class="container-fluid">
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW POST
                                </h2>
                        </div>

                        <div class="body">
                            <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                                {{-- CSRF Token --}}
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="postName" name="postName" class="form-control" value="{{ old('postName') }}" >
                                        <label class="form-label">Post Name</label>
                                    </div>
                                    @error('postName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- image Input --}}
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" id="image" name="image" class="form-control" value="" >
                                    </div>
                                   

                                <br>

                                <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.index') }}">Back</a>
                                 <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            
        </div>
@endsection

@push('js')
    
@endpush