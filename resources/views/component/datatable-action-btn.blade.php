<div class="btn-group">
    <button type="button" onclick="editForm(`{{route('charAjax.update',$data->id)}}`)" class="btn btn-warning btn-sm"
        data-toggle="modal" data-target="#addCharModal">
        <i class="fas fa-edit"></i>
    </button>
    <button type="button" onclick="deleteChar(`{{route('charAjax.destroy',$data->id)}}`)" class="btn btn-danger btn-sm">
        <i class="fas fa-eraser"></i>
    </button>
</div>