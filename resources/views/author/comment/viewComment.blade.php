@extends('admin.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h2 style="background-color: greenyellow;">All Comments
                <span class="glyphicon glyphicon-bell"></span></h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="text-center">Comment Info</th>
                            <th class="text-center">Post Info</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        @foreach($post->comments as $comment)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <a><img src="{{Storage::disk('public')->url('profile/'.$comment->user->image)}}" height="64" width="64"></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $comment->user->name }}
                                        <small>{{ $comment->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <p>{{ $comment->comment }}</p>
                                    <a target="blank" href="{{ route('post.details',$comment->post->slug.'#comments')}}">Reply</a>
                                </div>
                            </td>
                            
                            <td>
                                <div class="media">
                                    <div class="media-right">
                                        <a target="blank" href="{{ route('post.details',$comment->post->slug)}}">
                                            <img src="{{Storage::disk('public')->url('post/'.$comment->post->image)}}" height="64" width="64">
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ str_limit($comment->post->title,'40') }}
                                        <small>by {{ $comment->post->user->name}}</small>
                                    </h4>
                                </div>
                            </td>
                            
                            <td>
                                <button type="button" class="btn btn-danger" onclick="deleteComments({{$comment->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                     <form id="delete-form-{{$comment->id }}" action="{{ route('author.comment.destroy',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                            </td>
                        </tr>
                        @endforeach
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
    function deleteComments(id){
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
