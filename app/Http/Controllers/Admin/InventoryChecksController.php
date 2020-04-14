<?php

namespace App\Http\Controllers\Admin;
use Session;
use Carbon\Carbon;
use App\Inventory;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryChecksController extends Controller
{
    public function edit($id)
    {
        $item = Inventory::find($id);
        return view('admin.inventory.inventory-check.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $cp = $request->get('camera_present_yn');
        $pb = $request->get('plastic_box_yn');
        $l = $request->get('lock_yn');
        $il = $request->get('item_list_yn');
        $b = $request->get('batteries_yn');
        $sd = $request->get('sd_cards_yn');
        $cw = $request->get('camera_working_yn');
        $r = $request->get('check_remarks');

        DB::table('inventories')
            ->where('id', $id)
            ->update([
                'camera_present_yn' => $cp,
                'plastic_box_yn' => $pb,
                'lock_yn' => $l,
                'item_list_yn' => $il,
                'batteries_yn' => $b,
                'sd_cards_yn' => $sd,
                'camera_working_yn' => $cw,
                'checked_remarks' => $r,
                'updated_at' => Carbon::now()
            ]);

        $inventory = Inventory::where('id','=',$id)->first();
        // First If Camera is Missing, set to Missing
        if ($cp == 0) {
            $status_id = 3;
            $ts = 1;
        }
        else {
            $check_array = array($cp,$pb,$l,$il,$b,$sd,$cw);
            if (in_array(0, $check_array)) {
                // Equipment Check Failure
                $status_id = 6;
                $ts = 1;
            } else {
                // Equipment Check Pass
                if ($inventory->status_id == 6) {
                    $status_id = 1;
                    $ts = 1;
                } else {
                    // Else No Change to Status
                    $status_id = $inventory->status_id;
                    $ts = 0;
                }
            }
        }
        DB::table('inventories')
            ->where('id', $id)
            ->update([
                'status_id' => $status_id,
            ]);

        // If status changed then record timestamp
        if($ts == 1) {
            DB::table('inventory_status_timestamps')
                ->insert([
                    'inventory_id' => $id,
                    'inventory_status_id' => $status_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
        }

        Session::flash('flash_message', 'Inventory Check has been updated.');
        return redirect()->action('Admin\LibrariesController@show', ['id' => $inventory->library_id]);
    }

}
