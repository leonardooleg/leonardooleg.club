
<label for="">Импортируемая категория</label>
<input type="text" class="form-control" name="import_name" placeholder="Заголовок категории" value="{{$category->import_name ?? ""}}" required>


<label for="">Нужная категория</label>
<select class="form-control" name="category_id">
    <option value="0">-- не выбрано --</option>
    @include('admin.category_imports.partials.categories', ['categories' => $categories, 'delimiter'  => ''])
</select>


<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">
