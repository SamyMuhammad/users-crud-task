<div class="address-row">
    <div class="form-group col-3">
        <label for="InputAddressName{{ $key }}">Address Name</label>
        <input type="text" name="addresses[address_name][{{ $key }}]"
            value="{{ getInputValue("addresses.address_name.".$key, $item) }}" class="form-control"
            id="InputAddressName{{ $key }}" placeholder="Enter Address Name" required>
    </div>

    <div class="form-group col-3">
        <label for="InputAddress{{ $key }}">Address</label>
        <input type="text" name="addresses[address][{{ $key }}]" value="{{ getInputValue("addresses.address.".$key, $item) }}"
            class="form-control" id="InputAddress{{ $key }}" placeholder="Enter Address" required>
    </div>

    <div class="form-group col-3">
        <label for="InputAddressMobile{{ $key }}">Address Mobile</label>
        <input type="text" name="addresses[address_mobile][{{ $key }}]"
            value="{{ getInputValue("addresses.address_mobile.".$key, $item) }}" class="form-control"
            id="InputAddressMobile{{ $key }}" placeholder="Enter Address Mobile">
    </div>
    @if (!$loop->first)
    <button type="button" onclick="this.parentNode.remove()" class="btn btn-danger"><i class="far fa-times-circle"></i></button>
    @endif
</div>