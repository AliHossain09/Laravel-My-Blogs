@extends('layouts.backend.app')

@section('title', 'Show Post')

@push('css')
   
@endpush

@section('content')
    <div class="container-fluid">
        {{-- Strat Head Section --}}
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bg-cyan" style="margin-bottom: 20px; padding-top: 10px; padding-bottom: 10px; padding-left: 20px; ">
                        {{-- Header --}}
                        
                            <div class="header" style="display: flex; align-items: center;">
                                <i class="material-icons">library_books</i>
                                <span>POST</span>
                            </div>
                        
                    </div>
                    {{-- Approve & Back Button --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; ">
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('author.post.index') }}">Back</a>
                        @if ( $post->is_approved == false)
                            <button type="button" class="btn btn-success waves-effect"> 
                                <i class="material-icons">done</i>
                                <span>Approve</span>
                            </button>
                            @elseif ( $post->is_approved == true)
                            <button type="button" class="btn btn-success waves-effect" disabled> 
                                <i class="material-icons">done</i>
                                <span>Approved</span>
                            </button>
                        @else
                            <button type="button" class="btn btn-danger waves-effect"> 
                                <i class="material-icons">close</i>
                                <span>Rejected</span>
                            </button>
                        @endif

                        {{-- Approve Button --}}
                        {{-- @if ($post->status == 'pending')
                        <a class="btn btn-warning m-t-15 waves-effect" href="{{ route('admin.post.approve', $post->id) }}">Approve</a>
                        @elseif ($post->status == 'approved')
                        <a class="btn btn-success m-t-15 waves-effect" href="{{ route('admin.post.approve', $post->id) }}">Approved</a>
                        @else
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.approve', $post->id) }}">Rejected</a>
                            
                        @endif --}}
                        
                </div>
                <br>

                </div>
        </div>
        {{-- End Head Section --}}

            <!-- Start Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                {{-- Add New Post --}}
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               {{ $post->title }}
                            <small>Posted By: 
                                <strong>
                                    <a href="">{{ $post->user->name }}

                                    </a>
                                </strong>On: {{$post->created_at->format('d M Y')}}
                            </small>
                                </h2>
                        </div>

                        <div class="body">
                            {!! $post->body !!}
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
                        </div>
                </div>
            </div>
                            {{-- Right Side --}}
                {{-- Add Categories, Tags & Featured Image --}}
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    {{-- Show Categories --}}
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2> CATEGORIES </h2>
                        </div>

                        <div class="body">
                            @foreach ($post->categories as $category)
                                <span class="badge bg-cyan">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    {{-- Show Tags--}}
                    <div class="card">
                        <div class="header bg-green">
                            <h2> TAGS </h2>
                        </div>

                        <div class="body">
                            @foreach ($post->tags as $tag)
                                <span class="badge bg-green">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    {{-- Show Feautred Image --}}
                    <div class="card">
                        <div class="header bg-purple">
                            <h2> Feautred Imag </h2>
                        </div>

                        <div class="body">
                            <img src="{{ asset('postImages/'. $post->image) }}" alt="Post Image" class="img-responsive thumbnail">
                           </div>
                    </div>
                </div>
            </div>
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

