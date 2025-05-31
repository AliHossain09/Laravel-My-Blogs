@extends('layouts.backend.app')

@section('title', 'Settings')


@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            SETTINGS
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile_only_icon_title" data-toggle="tab">
                                    <i class="material-icons">face</i>UPDATE PROFILE
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#password_only_icon_title" data-toggle="tab">
                                    <i class="material-icons">password</i>PASSWORD
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile_only_icon_title">
                                {{-- Form --}}
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="header">
                                            
                                            <div class="body">
                                                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" >
                                                    @csrf
                                                    @method('PUT')

                                                     <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="name">Name</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="name"
                                                                        class="form-control"
                                                                        placeholder="Enter your name" name="name" value="{{ auth()->user()->name }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="email">Email Address</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="email"
                                                                        class="form-control"
                                                                        placeholder="Enter your email address" name="email" value="{{ auth()->user()->email }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="image">Profile Image</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="file" id="image"
                                                                        name="image" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="about">About:</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <textarea name="about" id="about" cols="30" rows="5" class="form-control"> {{ auth()->user()->about }} </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="row clearfix">
                                                        <div
                                                            class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                            <button type="summit"
                                                                class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="password_only_icon_title">
                                <b>Password Content</b>
                                <p>
                                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an.
                                    Pri ut tation electram moderatius.
                                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                    pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                    sadipscing mel.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
@endpush
