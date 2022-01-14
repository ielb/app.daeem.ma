<div class="row">
    <div class="col-md-12 center mt-5">
      <form action="{{route('driver.edit')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="DRIVER_MOTORCYCLE_PRICE">DRIVER MOTORCYCLE PRICE</label>
          <input type="text" class="form-control" id="DRIVER_MOTORCYCLE_PRICE" name="DRIVER_MOTORCYCLE_PRICE" value="{{env('DRIVER_MOTORCYCLE_PRICE')}}">
        </div>
        <div class="form-group ">
          <label for="DRIVER_CAR_PRICE">DRIVER CAR PRICE</label>
          <input type="text" class="form-control" id="DRIVER_CAR_PRICE" name="DRIVER_CAR_PRICE" value="{{env('DRIVER_CAR_PRICE')}}">
        </div>
        <hr width="75%">
        <div class="form-group ">
          <label for="COLLECTION_PRODUCT_PRICE">COLLECTION PRODUCT PRICE</label>
          <input type="text" class="form-control" id="COLLECTION_PRODUCT_PRICE" name="COLLECTION_PRODUCT_PRICE" value="{{env('COLLECTION_PRODUCT_PRICE')}}">
        </div>
        <div class="form-group ">
          <label for="COLLECTION_PRICE">COLLECTION PRICE</label>
          <input type="text" class="form-control" id="COLLECTION_PRICE" name="COLLECTION_PRICE" value="{{env('COLLECTION_PRICE')}}">
        </div>
        <div class="form-group text-center pt-3">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>