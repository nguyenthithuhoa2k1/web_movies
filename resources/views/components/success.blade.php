@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        {{session('success')}}
    </div>
@endif