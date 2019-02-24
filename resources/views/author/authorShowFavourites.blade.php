@extends('admin.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h2 style="background-color: greenyellow;">All Favourites
                <span class="glyphicon glyphicon-bell">{{ $favouritePosts->count() }}</span></h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Sl.NO</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Favourite</th>
                            <!--<th>Comments</th>-->
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($favouritePosts as $favouritePost)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td>{{str_limit($favouritePost->title,'10') }}</td>
                            <td>{{$favouritePost->user->name }}</td>
                            <td>{{$favouritePost->favourite_to_users->count() }}</td>
                            <td>{{$favouritePost->view_count }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger" onclick="deleteFavourite({{$favouritePost->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                     <form id="delete-form-{{$favouritePost->id }}" action="{{ route('post.favourite',$favouritePost->id)}}" method="POST">
                                    @csrf
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.all.min.js
"></script>
<script type="text/javascript">
    function deleteFavourite(id){
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
    document.getElementById('delete-form-'+id).submit();
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