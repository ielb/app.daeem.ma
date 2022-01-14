<div class="card card-profile bg-secondary shadow">
    <div class="card-header">

        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">{{ __("Store Area")}}</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <style>
            #map_area{
                height: 500px;
            }
        </style>
        <div id="map_area" class="form-control form-control-alternative"></div>
        <br/>
        <button type="button" id="save" class="btn btn-success btn-sm btn-block">{{__("Save")}}</button>
        <input type="hidden" name="vertices" value="" id="vertices">
        <button type="button" id="clear_area" class="btn btn-danger btn-sm btn-block">{{ __("Clear Delivery Area")}}</button>
    </div>
</div>