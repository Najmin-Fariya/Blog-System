@extends('admin.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 style="background-color: greenyellow;">All Authors 
                    <span class="glyphicon glyphicon-bell">{{ $authors->count() }}</span></h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Posts</th>
                            <th>Comments</th>
                            <th>Favourite Posts</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach($authors as $author)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td>{{ $author->name}}</td>
                            <td>{{ $author->posts_count}}
                            <td>{{ $author->comments_count}}</td> 
                            <td>{{ $author->favourite_posts_count}}</td>
                            <td>{{ $author->created_at->toDateString()}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger" onclick="deleteAuthor({{$author->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{$author->id }}" action="{{ route('admin.authors.destroy',$author->id)}}" method="POST">
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
                            function deleteAuuthor(id){
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