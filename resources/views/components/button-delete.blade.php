<form action="{{ $action ?? '' }}" method="post" class="d-inline delete">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
</form>
