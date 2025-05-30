@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')
        <!-- JQuery DataTable Css -->
     <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
            <div class="block-header">
                
                <a class="btn btn-primary" href="{{ route('admin.post.create') }}" role="button">
                    <i class="material-icons">add</i>
                    <span>Add New Post</span>
                </a>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL POSTS
                                <span class=" badge bg-blue ">{{$posts->count()}}</span>

                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th> <i class="material-icons">visibility</i> </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th> <i class="material-icons">visibility</i> </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                             <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    @php
                                    use Illuminate\Support\Str;
                                    @endphp

                                    <tbody>
                                        @foreach ($posts as $key=>$post)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ str::limit($post->title,'10') }}</td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->view_count }}</td>

                                                <td>
                                                    @if ($post->is_approved == true)
                                                        <span class="badge bg-green">Approved</span>
                                                    @else
                                                        <span class="badge bg-red">Pending</span>
                                                        
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($post->status == true)
                                                        <span class="badge bg-green">Published</span>
                                                    @else
                                                        <span class="badge bg-red">Unpublished</span>
                                                    @endif
                                                </td>
                                                


                                                <td>{{ $post->created_at }}</td>
                                                <td>{{ $post->updated_at }}</td>
                                                <td class="text-center">
                                                    <img class="img-thumbnail" src="{{ asset('postImages/'.$post->image) }}" style="width: 100px; height: auto;"> </td>
                                                 <td>
                                                    <div style="display: flex; justify-content: space-around; gap: 5px;">
                                                    <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-success waves-effect">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-info waves-effect">
                                                        <i class="material-icons">edit</i>
                                                    </a>

                                                    <button class="btn btn-danger waves-effect" type="button"
                                                    onclick="deletePost({{$post->id}})">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                    </div>

                                                    <form id="delete-form-{{$post->id}}" action="{{ route('admin.post.destroy', $post->id) }}"method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                            </tr>
                                       @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@endsection


@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script> 

    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

    {{--Delete & Sweetalert Method--}}
    <script>
        function deletePost(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
    {{-- Sweetalert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                                                             
@endpush
