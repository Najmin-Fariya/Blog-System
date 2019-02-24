@extends('admin.dashboard')
@section('content')

<h2></h2>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>{{ $post->title}}</h2>
                <small>Posted By <strong><a href="">{{ $post->user->name}}</a></strong> on <span style="color:green;">{{ $post->created_at}}</span></small>
                <!-- toFormattedDateString() use korte hobe date time k readable korar jonno/ -->
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <h4 class="text-center"> Status</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        @if($post->is_approved == false)
                                        <button type="button" class="btn btn-warning" onclick="approvePost({{$post->id}})">
                                                Need to Approve
                                            </button>
                                            <form id="approval-form" action="{{ route('admin.post.approve',$post->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @else
                                            <button class="btn btn-success" disabled >Already Approved</button>
                                        @endif
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <h4 class="text-center"> Categories</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        <ol style="color: #0066cc;">
                                            @foreach($post->categories as $category)
                                            <li> {{ $category->categoryName }} </li>
                                            @endforeach
                                        </ol>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                    <h4 class="text-center"> Tags</h4>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        <ol style="color: #009933;">
                                            @foreach($post->tags as $tag)
                                            <li> {{ $tag->tagName }} </li>
                                            @endforeach
                                        </ol>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h4 class="text-center"> Featured Image</h4>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        <image src="{{ Storage::disk('public')->url('post/'.$post->image)}}" height="100px" width="180px">
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <!--//end of row-->
                </div>
                <!--end of panel-body-->
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h3> Post Body</h3>
                            </div>
                            <div class="panel-body">
                                <strong>
                                    {!! $post->body !!}
                                </strong>
                            </div>
                            <div class="panel-footer">
                                <a href="{{ route('admin.post.index')}}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
        </div> <!-- /end .row) -->
    </div> <!-- /.panel-body -->
</div><!-- /.panel -->
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
                            function approvePost(id){
                            const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success',
                                    cancelButtonClass: 'btn btn-danger',
                                    buttonsStyling: false,
                            })

                                    swalWithBootstrapButtons({
                                    title: 'Are you sure?',
                                            text: "You want to approve this?",
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Yes, approve it!',
                                            cancelButtonText: 'No, cancel!',
                                            reverseButtons: true
                                    }).then((result) => {
                            if (result.value) {
                            event.preventDefault();
                            document.getElementById('approval-form').submit();
                            } else if (
                                    // Read more about handling dismissals
                                    result.dismiss === swal.DismissReason.cancel
                                    ) {
                            swalWithBootstrapButtons(
                                    'Cancelled',
                                    'Post remain pending',
                                    'info'
                                    )
                            }
                            })
                            }
</script>
@endsection




