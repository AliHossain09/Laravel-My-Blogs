@extends('layouts.backend.app')

@section('title', 'Create Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Start Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                {{-- Add New Post --}}
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW POST
                                </h2>
                        </div>

                        <div class="body">
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="postTitle" name="postTitle" class="form-control" value="{{ old('postTitle') }}" >
                                        <label class="form-label">Enter Title Here</label>
                                    </div>
                                    @error('postTitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- image Input --}}
                                <div class="form-group">
                                    <label for="image">Featured Image</label>
                                   <input type="file" id="image" name="image" class="form-control" value="" >
                                    </div>

                                    <!-- Publish Checkbox -->
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="publish">
                            <label for="publish">Publish</label>
                        </div>

                    </div>
                </div>
            </div>
                {{-- Add Categories & Tags --}}
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CATEGORIES & TAGS
                                </h2>
                        </div>

                        <div class="body">
                          {{-- Select Category  Type --}}
                                <div class="form-group">
                                    <label for="category">Select Category</label>
                                    <select class="form-control show-tick" name="category_id" id="category"  multiple>
                                        {{-- <option value="">-- Please select --</option> --}}
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Select Tages  Type --}}
                                <div class="form-group">
                                    <label for="tags">Select Tags</label>
                                    <select class="form-control show-tick" name="tags[]" id="tags"  multiple>
                                        {{-- <option value="">-- Please select --</option> --}}
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group " style="display: flex; justify-content: space-between;">
                                     <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.index') }}">Back</a>
                                 <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                                </div>
                                
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- End Vertical Layout | With Floating Label -->
             
              <!-- Down Vertical Layout | With Floating Label -->
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BODY
                                </h2>
                        </div>

                        <div class="body">
                            <textarea name="body" id="tinymce" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    
    {{-- TinyMCE editor  --}}
    <script>
        $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
});
    </script>

@endpush