@extends('layouts.backend.app')

@section('title', 'Create Tag')

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
                                ADD NEW TAG
                                </h2>
                        </div>

                        <div class="body">
                            <form action="{{ route('admin.tag.store') }}" method="POST">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="TagName" name="TagName" class="form-control" value="{{ old('TagName') }}" >
                                        <label class="form-label">Tag Name</label>
                                    </div>
                                    @error('TagName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                

                                <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}">Back</a>
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