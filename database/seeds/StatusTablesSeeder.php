<?php
use App\ReservationStatus;
use App\InventoryStatus;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class StatusTablesSeeder extends Seeder
{
    /**
     * To Run Seeder: php artisan db:seed --class=StatusTablesSeeder
     */
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rsData = array(
            array(
                'status_name' => 'Open',
                'remarks' => 'Reservation Open. The volunteer has an inventory item checked out',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'status_name' => 'Closed',
                'remarks' => 'Reservation Closed. The volunteer has returned an inventory item to the library',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('reservations_status')->delete();
        DB::table('reservations_status')->insert($rsData);
        $inventoryData = array(
            array(
                'status_name' => 'Available',
                'status_code' => 'A',
                'remarks' => 'Inventory item is available for reservation.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'status_name' => 'Reserved',
                'status_code' => 'R',
                'remarks' => 'Inventory item belongs to an open reservation and therefore is not available for checkout.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'status_name' => 'Missing',
                'status_code' => 'M',
                'remarks' => 'Inventory item is missing and not available for checkout.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'status_name' => 'Unavailable (Unknown)',
                'status_code' => 'UU',
                'remarks' => 'Unavailable for unknown reason, this status is a placeholder for imported data until the specific regarding the availability are sorted out.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'status_name' => 'Unknown',
                'status_code' => 'UU',
                'remarks' => 'Status is unknown, this status is ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'status_name' => 'Unavailable (Equipment Failure)',
                'status_code' => 'UE',
                'remarks' => 'Unavailable for reservation due to one of more failures during equipment check',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('inventory_status')->delete();
        DB::table('inventory_status')->insert($inventoryData);

    }
}
