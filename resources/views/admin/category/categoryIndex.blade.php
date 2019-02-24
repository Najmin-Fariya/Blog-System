@extends('admin.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><a class="btn btn-primary" href="{{ route('admin.category.create')}}"><i class="fa fa-plus">
                    <span>Add New Category</span></i></a></h2>
                    <h2 style="background-color: greenyellow;">All Category <span class="glyphicon glyphicon-bell">{{ $categories->count() }}</span></h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Tag Name</th>
                            <th>Post Count</th>
                            <th>Image</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td>{{ $category->categoryName}}</td>
                            <td>{{ $category->posts->count()}}
                            <td>{{ $category->image}}</td> 
                            <td>{{ $category->created_at}}</td>
                            <td>{{ $category->updated_at}}</td> 
                            <td class="text-center">
                                <button class="btn btn-dafault">
                                    <a href="{{ route('admin.category.edit',$category->id)}}" style="text-decoration: none;"> 
                                        <i class="fa fa-edit"></i> </a>
                                </button>
                                <button type="button" class="btn btn-danger" onclick="deleteCategory({{$category->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{$category->id }}" action="{{ route('admin.category.destroy',$category->id)}}" method="POST">
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
                            function deleteCategory(id){
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