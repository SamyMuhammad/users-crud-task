<div class="card-body">
    <div>
        <div class="form-group col-3">
            <label for="InputName">Name</label>
            <input type="text" name="name" value="{{ getInputValue('name', $item) }}" class="form-control"
                id="InputName" placeholder="Enter Name" required>
        </div>

        <div class="form-group col-3">
            <label for="InputMobile">Mobile</label>
            <input type="text" name="mobile" value="{{ getInputValue('mobile', $item) }}" class="form-control"
                id="InputMobile" placeholder="Enter Mobile" required>
        </div>

        <div class="form-group col-3">
            <label for="InputEmail">Email address</label>
            <input type="email" name="email" value="{{ getInputValue('email', $item) }}" class="form-control"
                id="InputEmail" placeholder="Enter Email" required>
        </div>

        <div class="form-group col-3">
            <label for="InputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Enter Password"
            {{ request()->routeIs('users.create') ? 'required' : '' }}>
        </div>

        <div class="form-group col-3">
            <label for="birthdate">Birth Date</label>
            <div class="input-group date" id="birthdate" data-target-input="nearest">
                <input type="text" name="birth_date" value="{{ getInputValue('birth_date', $item) }}" class="form-control datetimepicker-input" data-target="#birthdate">
                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            <h4 class=display-inline-block>Add Address to user</h4> <button type="button" class="btn btn-info float-right" onclick="addAddress()">Add another address</button>
        </div>
        <div id="address-rows-container" class="card-body">
            @if (request()->routeIs('users.create'))
            <div class="address-row">
               <div class="form-group col-3">
                    <label for="InputAddressName1">Address Name</label>
                    <input type="text" name="addresses[address_name][1]"
                        value="{{ getInputValue("addresses.address_name.1", $item) }}" class="form-control"
                        id="InputAddressName1" placeholder="Enter Address Name" required>
                </div>
            
                <div class="form-group col-3">
                    <label for="InputAddress1">Address</label>
                    <input type="text" name="addresses[address][1]" value="{{ getInputValue("addresses.address.1", $item) }}"
                        class="form-control" id="InputAddress1" placeholder="Enter Address" required>
                </div>
            
                <div class="form-group col-3">
                    <label for="InputAddressMobile1">Address Mobile</label>
                    <input type="text" name="addresses[address_mobile][1]"
                        value="{{ getInputValue("addresses.address_mobile.1", $item) }}" class="form-control"
                        id="InputAddressMobile1" placeholder="Enter Address Mobile">
                </div>
            </div> 
            @endif
            
            @if (!empty(old('addresses.address_name')) && is_array(old('addresses.address_name')))
                @foreach (old('addresses.address_name') as $key => $value)
                @if ($key==1) @continue @endif
                    @include('users.address_row', compact('item', 'key', 'value'))
                @endforeach
            @elseif (!empty($item))
                @foreach ($item->addresses as $key => $value)
                    @include('users.address_row_from_db', compact('item', 'key', 'value'))
                @endforeach
            @endif
            
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

@section('scripts')
    <script>
        //Date picker
        $('#birthdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        var addressRowsCount = $('.address-row').length+1;

        function addAddress() {
            let addressRow = `
                <div class="address-row">
                    <div class="form-group col-3">
                        <label for="InputAddressName`+addressRowsCount+`">Address Name</label>
                        <input type="text" name="addresses[address_name][`+addressRowsCount+`]" class="form-control"
                            id="InputAddressName`+addressRowsCount+`" placeholder="Enter Address Name" required>
                    </div>
                
                    <div class="form-group col-3">
                        <label for="InputAddress`+addressRowsCount+`">Address</label>
                        <input type="text" name="addresses[address][`+addressRowsCount+`]" class="form-control"
                        id="InputAddress`+addressRowsCount+`" placeholder="Enter Address" required>
                    </div>
                
                    <div class="form-group col-3">
                        <label for="InputAddressMobile`+addressRowsCount+`">Address Mobile</label>
                        <input type="text" name="addresses[address_mobile][`+addressRowsCount+`]" class="form-control"
                            id="InputAddressMobile`+addressRowsCount+`" placeholder="Enter Address Mobile">
                    </div>
                    <button type="button" onclick="this.parentNode.remove()" class="btn btn-danger"><i class="far fa-times-circle"></i></button>
                </div>
            `;

            $('#address-rows-container').append(addressRow);
            addressRowsCount++;
        }
    </script>
@endsection