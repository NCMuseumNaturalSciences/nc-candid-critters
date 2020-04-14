<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Camera;
use App\Http\Requests\InventoriesFormRequest;
use App\InventoryStatus;
use App\Library;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventory;
class InventoryController extends Controller
{
    /**
     * Inventory Datatable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statuses = InventoryStatus::all();
        $libraries = Library::all();
        $cameras = Camera::all();
        return view('admin.inventory.datatable', compact('statuses','cameras','libraries'));
    }
    /**
     * Show Inventory
     */
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        $statusSet = InventoryStatus::all();
        return view('admin.inventory.show', compact('inventory','statusSet'));
    }


    /**
     * Add Camera to Inventory
     */
    public function store(InventoriesFormRequest $request)
    {
        $inventory = new Inventory;
        if($request->get('library_id')) {
            $inventory->library_id = $request->get('library_id');
        }
        $inventory->camera_id = $request->get('camera_id');
        $inventory->barcode = $request->get('barcode');
        $inventory->nccc_id = $request->get('nccc_id');
        $inventory->remarks = $request->get('remarks');
        $inventory->status_id = 1;
        $inventory->save();
        Session::flash('flash_message', 'Inventory updated!');
        return redirect()->action('Admin\InventoryController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $libraries = Library::all();
        $cameras = Camera::all()->sortBy('make_model');
        $inventory = Inventory::whereId($id)->firstOrFail();
        $statusSet = InventoryStatus::all();
        return view('admin.inventory.edit', compact('inventory','cameras', 'user','libraries','statusSet'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoriesFormRequest $request, $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());
        Session::flash('flash_message', 'Inventory updated!');
        return redirect()->action('Admin\InventoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::destroy($id);
        Session::flash('flash_message', 'Inventory deleted!');
        return redirect()->action('Admin\InventoryController@index');
    }



	/**
	* Change Inventory Status Manually
	*
	*/
	public function changeStatus(Request $request)
	{
		$id = $request->get('inventory_id');
        $status_id = $request->get('status_id');

        $inventory = Inventory::findOrFail($id);
        $inventory->update([
            'status_id' => $status_id,
            'updated_at' => Carbon::now(),
        ]);

        Session::flash('flash_message', 'Inventory status has been updated.');
        return redirect()->action('Admin\InventoryController@show', ['id' => $id]);
	}

    /**
     * Get Library Available Inventory using Library ID ($id)
     * For cascade dropdowns
     */
    public function getLibraryAvailableInventory($id)
    {
        $inventory = Inventory::where('library_id','=',$id)->with('status')->where('status_id','=',1)->get();
        return $inventory;
    }
    /**
     * Get Library Entire Inventory using Library ID ($id)
     * For cascade dropdowns
     */
    public function getLibraryInventory($id)
    {
        $inventory = Inventory::where('library_id','=',$id)->with('status')->get();
        return $inventory;
    }
}

