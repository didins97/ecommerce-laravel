<form action="{{ route('categories.update', $cat->id) }}" method="POST" id="edit-form">
    @csrf @method('PATCH')
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $cat->name }}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    @if (!$cat->is_parent)
    <div class="form-group" id="parent_cat_div">
        <label for="">Kategori</label>
        <select class="form-control" name="parent_id">
            @foreach ($parent_categories as $parent)
            <option value="{{$parent->id}}" @if ($cat->parent_id == $parent->id)
                selected
                @endif>{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>
    @else
    <input type="hidden" name="is_parent" value="1">
    @endif
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary save">Update</button>
    </div>
</form>
