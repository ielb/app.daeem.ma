<select class="form-control d-none select2 form-control-alternative" id="product_subcategory_select" >
    @foreach ($categories as $category)
        <optgroup label="{{ $category->name }}">
            @foreach($category->subcategories as $selectedsubcategory)
                @if($selectedsubcategory->id == $subcategory->id)
                    <option selected value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @else
                    <option value="{{ $selectedsubcategory->id }}">{{ $selectedsubcategory->name }}</option>
                @endif
            @endforeach
        </optgroup>
    @endforeach
</select>