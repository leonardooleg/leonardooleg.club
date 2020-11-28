<label for=""><b>Выберите принадлежность</b></label>
<div class="form-row">
    <div class="col">
        <label for="">Родительская категория</label>
        <select class="form-control" name="category_id">
            <option value="0">-- для всех категорий --</option>
            @include('admin.sizes.partials.categories', ['categories' => $categories, 'delimiter'  => ''])
        </select>
    </div>
    <div class="col">
        <label for="">Для бренда</label>
        <select class="form-control" name="brand_id">
            <option value="0">-- для всех брендов --</option>
            @foreach($brands as $brand)
                <option value="{{$brand->id}}" @if(isset($size))@if($brand->id==$size->brand_id) selected @endif @endif>{{$brand->name_brand}}</option>
            @endforeach
        </select>
    </div>
</div>


<br><hr>
<label for=""><b>Характеристики</b></label>
<div class="form-group ">
    <label for="inputZip">Размер бренда</label>
    <input type="text" name="brand_name_size" class="form-control" value="{{$size->brand_name_size ?? ''}}">
</div>
<div class="form-group ">
    <label for="inputZip">Российский размер</label>
    <input type="text" name="rus_name_size" class="form-control" value="{{$size->rus_name_size ?? ''}}">
</div>
<div class="form-group ">
    <label for="inputZip">Обхват груди</label>
    <input type="text" name="grudi_size" class="form-control" value="{{$size->grudi_size ?? ''}}">
</div>
<div class="form-group ">
    <label for="inputZip">Обхват под грудью </label>
    <input type="text" name="pod_grudyu_size" class="form-control" value="{{$size->pod_grudyu_size ?? ''}}">
</div>
<div class="form-group ">
    <label for="inputZip">Обхват талии</label>
    <input type="text" name="talii_size" class="form-control" value="{{$size->talii_size ?? ''}}">
</div>
<div class="form-group ">
    <label for="inputZip">Обхват бедер</label>
    <input type="text" name="bedra_size" class="form-control" value="{{$size->bedra_size ?? ''}}">
</div>
<div class="form-group ">
    <label for="inputZip">Длина стопы</label>
    <input type="text" name="stopy_size" class="form-control" value="{{$size->stopy_size ?? ''}}">
</div>









<hr><br>
<button type="submit" class="btn btn-primary float-right">Добавить</button>

