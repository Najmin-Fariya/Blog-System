@extends('admin.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><a class="btn btn-primary" href="{{ route('admin.post.create')}}"><i class="fa fa-plus">
                            <span>Add New Post</span></i></a></h2> 
                <h2 style="background-color: greenyellow;">All Posts <span class="glyphicon glyphicon-bell">{{ $posts->count() }}</span></h2>
                
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th><i class="fa fa-eye"></i></th>
                            <th>Is approved</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td>{{ str_limit($post->title,'10') }}</td>
                            <td>{{ $post->user->name}}</td> 
                            <td>{{ $post->view_count}}</td> 
                            <td>
                                @if($post->is_approved == true)
                                <span style="background-color: green;color: white;">Approved</span>
                                @else
                                <span style="background-color: red;color: white;">Pending</span>
                                @endif
                            </td> 
                            <td>
                                @if($post->status == true)
                                <span style="background-color: green;color: white;">Published</span>
                                @else
                                <span style="background-color: red;color: white;">Pending</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at}}</td>
                            <td>{{ $post->updated_at}}</td> 
                            <td class="text-center">
                                <button class="btn btn-dafault">
                                    <a title="View post details" href="{{ route('admin.post.show',$post->id)}}" style="text-decoration: none; color: #2795e9;"> 
                                        <i class="fa fa-eye"></i> </a>
                                </button>
                                <button class="btn btn-dafault">
                                    <a title="Edit your post" href="{{ route('admin.post.edit',$post->id)}}" style="text-decoration: none;"> 
                                        <i class="fa fa-edit"></i> </a>
                                </button>
                                <button type="button" class="btn btn-danger" onclick="deletePost({{$post->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{$post->id }}" action="{{ route('admin.post.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
                            function deletePost(id){
                            const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success',
                                    cancelButtonClass: 'btn btn-danger',
                                    buttonsStyling: false,
                            })

                                    swalWithBootstrapButtons({
                                    title: 'Are you sure?',
                                            text: "You won't be able to revert this!",
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'No, cancel!',
                                            reverseButtons: true
                                    }).then((result) => {
                            if (result.value) {
                            event.preventDefault();
                            document.getElementById('delete-form-' + id).submit();
                            } else if (
                                    // Read more about handling dismissals
                                    result.dismiss === swal.DismissReason.cancel
                                    ) {
                            swalWithBootstrapButtons(
                                    'Cancelled',
                                    'Your Data  is safe :)',
                                    'error'
                                    )
                            }
                            })
                            }
</script>
@endsection