<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::paginate(15);

        return view('users.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        
        try {
            DB::transaction(function () use($data) {
                $user = User::create($data);
        
                for ($i=1; $i <= count($data['addresses']['address_name']); $i++) { 
                    Address::create([
                        'user_id' => $user->id,
                        'name' => $data['addresses']['address_name'][$i],
                        'address' => $data['addresses']['address'][$i],
                        'mobile' => $data['addresses']['address_mobile'][$i],
                    ]);
                }
            });
            session()->flash('success', 'User Stored Successfully!');
        } catch (\Throwable $th) {
            // throw $th;
            session()->flash('error', 'Somethong went wrong, Try again later.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('addresses');
        return view('users.edit', ['item' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        if (is_null($data['password'])) {
            unset($data['password']);
        }
        try {
            DB::transaction(function () use($user, $data) {
                $user->update($data);

                $keysArray = [];
                foreach ($data['addresses']['address_name'] as $key => $value) {
                    $keysArray[] = $key;
                    $address = Address::find($key);
                    if ($address) {
                        $address->update([
                            'name' => $data['addresses']['address_name'][$key],
                            'address' => $data['addresses']['address'][$key],
                            'mobile' => $data['addresses']['address_mobile'][$key],
                        ]);
                    } else {
                        Address::create([
                            'user_id' => $user->id,
                            'name' => $data['addresses']['address_name'][$key],
                            'address' => $data['addresses']['address'][$key],
                            'mobile' => $data['addresses']['address_mobile'][$key],
                        ]);
                    }
                }

                // Deleting addresses that are not presented on request.
                $allAddressesIds = $user->addresses->pluck('id')->toArray();
                Address::destroy(array_diff($allAddressesIds, $keysArray));
            });
            session()->flash('success', 'User Updated Successfully!');
        } catch (\Throwable $th) {
            // throw $th;
            session()->flash('error', 'Somethong went wrong, Try again later.');
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User Deleted Successfully!');
        return redirect()->route('users.index');
    }
}
