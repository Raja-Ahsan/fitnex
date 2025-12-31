<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\User;
use App\Models\ClientContact;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use Auth;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:advertisement-list|advertisement-create|advertisement-edit|advertisement-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:advertisement-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:advertisement-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:advertisement-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        if ($request->ajax()) {
            $query = Advertisement::orderby('id', 'desc')->where('id', '>', 0);

            // Apply search filter
            if ($request->has('search') && $request['search'] != "") {
                $query->where('name', 'like', '%' . $request['search'] . '%');
            }

            // Apply status filter
            if ($request->has('status') && $request['status'] != 'All') {
                $status = $request['status'] == 2 ? 0 : $request['status'];
                $query->where('status', $status);
            }

            // Restrict to own advertisements for Contractors
            if ($user->hasRole('Contractor')) {
                $query->where('created_by', $user->id); // Show only the advertisements created by this contractor
            }

            $advertisements = $query->paginate(10);
            return (string) view('admin.advertisement.search', compact('advertisements'));
        }

        // Non-AJAX request
        $page_title = 'All Advertisements';

        if ($user->hasRole('Contractor')) {
            // Show only own advertisements for Contractors
            $advertisements = Advertisement::where('created_by', $user->id)->orderby('id', 'desc')->paginate(10);
        } else {
            // Admins or other roles see all advertisements
            $advertisements = Advertisement::orderby('id', 'desc')->paginate(10);
        }

        return view('admin.advertisement.index', compact('advertisements', 'page_title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Add Advertisement";
        $cities = City::where('status', 1)->get();
        return view('admin.advertisement.create', compact('page_title' , 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:100',
            // 'description' => 'required|max:100',
            //'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $advertisement = new Advertisement();

        if (isset($request->image)) {
            $photo = date('y-m-d-His') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/advertisement'), $photo);
            $advertisement->image = $photo;
        }
        /* $advertisement->created_by = Auth::user()->name; */
        $advertisement->created_by = Auth::user()->id;
        $advertisement->name = $request->name;
        $advertisement->city_id = $request->city_id;
        $advertisement->state_id = $request->state_id;
        $advertisement->short_description = $request->short_description;
        $advertisement->description = $request->description;
        $advertisement->save();

        return redirect()->route('advertisement.index')->with('message', 'Advertisement added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    /* public function show($id)
    {
        $page_title = 'Details Advertisement';
        $contractor_detail = User::where('id', $id)->first();
        $advertisement = Advertisement::findOrFail($id); // Fetch the advertisement
        return view('admin.advertisement.details', compact('advertisement','page_title','property_sliderimages_detail')); // Return the view with the data
    } */

    public function show($id)
    {
        $page_title = 'Advertisement Details';

        // Fetch a single advertisement by its ID
        $advertisement = Advertisement::find($id);
        if (!$advertisement) {
            return redirect()->back()->withErrors(['error' => 'Advertisement not found.']);
        }

        // Fetch the contractor details based on the advertisement's created_by field
        $contractor_detail = User::find($advertisement->created_by);

        // Fetch the related client contacts
        $client_contacts = ClientContact::where('status', 1)->where('agent_id', $id)->get();
        $advertisements = Advertisement::where('status', 1)->get();
        // Fetch related advertisements (assuming you want to fetch some related advertisements)
        $related_advertisements = Advertisement::where('status', 1)->where('id', '!=', $id)->get();

        return view('admin.advertisement.details', compact('page_title','advertisements', 'contractor_detail', 'advertisement', 'client_contacts', 'related_advertisements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Advertisement';
        $advertisements = Advertisement::where('id', $id)->first();
        $cities = City::where('status', 1)->get();
        $states = State::where('city_id', $advertisements->city_id)->get();
        return view('admin.advertisement.edit', compact('advertisements', 'page_title','cities','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = Advertisement::where('id', $id)->first();
        $validator = $request->validate([
            'name' => 'required|max:100',
        ]);

        if (isset($request->image)) {
            $photo = date('y-m-d-His') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/advertisement'), $photo);
            $updates->image = $photo;
        }

        /* $updates->created_by = Auth::user()->name; */
        $updates->created_by = Auth::user()->id;
        $updates->name = $request->name;
        $updates->city_id = $request->city_id;
        $updates->state_id = $request->state_id;
        $updates->short_description = $request->short_description;
        $updates->description = $request->description;
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('advertisement.index')->with('message', 'Advertisement updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::where('id', $id)->first();
        if ($advertisement) {
            $advertisement->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
