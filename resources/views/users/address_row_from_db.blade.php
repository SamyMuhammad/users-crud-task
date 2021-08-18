<div class="address-row">
    <div class="form-group col-3">
        <label for="InputAddressName{{ $value->id }}">Address Name</label>
        <input type="text" name="addresses[address_name][{{ $value->id }}]"
            value="{{ $value->name }}" class="form-control"
            id="InputAddressName{{ $value->id }}" placeholder="Enter Address Name" required>
    </div>

    <div class="form-group col-3">
        <label for="InputAddress{{ $value->id }}">Address</label>
        <input type="text" name="addresses[address][{{ $value->id }}]" value="{{ $value->address }}"
            class="form-control" id="InputAddress{{ $value->id }}" placeholder="Enter Address" required>
    </div>

    <div class="form-group col-3">
        <label for="InputAddressMobile{{ $value->id }}">Address Mobile</label>
        <input type="text" name="addresses[address_mobile][{{ $value->id }}]"
            value="{{ $value->mobile }}" class="form-control"
            id="InputAddressMobile{{ $value->id }}" placeholder="Enter Address Mobile">
    </div>
    @if (!$loop->first)
        <button type="button" onclick="this.parentNode.remove()" class="btn btn-danger"><i class="far fa-times-circle"></i></button>
    @endif
</div>