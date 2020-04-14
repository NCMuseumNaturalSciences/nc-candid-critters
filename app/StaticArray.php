<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticArray extends Model
{
    public static $regions = [
        null => null,
        'Western' => 'Western',
        'Central' => 'Central',
        'Eastern' => 'Eastern'
    ];
    public static $nccounties = [
        null => null,
        "Alamance" => "Alamance",
        "Alexander" => "Alexander",
        "Alleghany" => "Alleghany",
        "Anson" => "Anson",
        "Ashe" => "Ashe",
        "Avery" => "Avery",
        "Beaufort" => "Beaufort",
        "Bertie" => "Bertie",
        "Bladen" => "Bladen",
        "Brunswick" => "Brunswick",
        "Buncombe" => "Buncombe",
        "Burke" => "Burke",
        "Cabarrus" => "Cabarrus",
        "Caldwell" => "Caldwell",
        "Camden" => "Camden",
        "Carteret" => "Carteret",
        "Caswell" => "Caswell",
        "Catawba" => "Catawba",
        "Chatham" => "Chatham",
        "Cherokee" => "Cherokee",
        "Chowan" => "Chowan",
        "Clay" => "Clay",
        "Cleveland" => "Cleveland",
        "Columbus" => "Columbus",
        "Craven" => "Craven",
        "Cumberland" => "Cumberland",
        "Currituck" => "Currituck",
        "Dare" => "Dare",
        "Davidson" => "Davidson",
        "Davie" => "Davie",
        "Duplin" => "Duplin",
        "Durham" => "Durham",
        "Edgecombe" => "Edgecombe",
        "Forsyth" => "Forsyth",
        "Franklin" => "Franklin",
        "Gaston" => "Gaston",
        "Gates" => "Gates",
        "Graham" => "Graham",
        "Granville" => "Granville",
        "Greene" => "Greene",
        "Guilford" => "Guilford",
        "Halifax" => "Halifax",
        "Harnett" => "Harnett",
        "Haywood" => "Haywood",
        "Henderson" => "Henderson",
        "Hertford" => "Hertford",
        "Hoke" => "Hoke",
        "Hyde" => "Hyde",
        "Iredell" => "Iredell",
        "Jackson" => "Jackson",
        "Johnston" => "Johnston",
        "Jones" => "Jones",
        "Lee" => "Lee",
        "Lenoir" => "Lenoir",
        "Lincoln" => "Lincoln",
        "McDowell" => "McDowell",
        "Macon" => "Macon",
        "Madison" => "Madison",
        "Martin" => "Martin",
        "Mecklenburg" => "Mecklenburg",
        "Mitchell" => "Mitchell",
        "Montgomery" => "Montgomery",
        "Moore" => "Moore",
        "Nash" => "Nash",
        "New Hanover" => "New Hanover",
        "Northampton" => "Northampton",
        "Onslow" => "Onslow",
        "Orange" => "Orange",
        "Pamlico" => "Pamlico",
        "Pasquotank" => "Pasquotank",
        "Pender" => "Pender",
        "Perquimans" => "Perquimans",
        "Person" => "Person",
        "Pitt" => "Pitt",
        "Polk" => "Polk",
        "Randolph" => "Randolph",
        "Richmond" => "Richmond",
        "Robeson" => "Robeson",
        "Rockingham" => "Rockingham",
        "Rowan" => "Rowan",
        "Rutherford" => "Rutherford",
        "Sampson" => "Sampson",
        "Scotland" => "Scotland",
        "Stanly" => "Stanly",
        "Stokes" => "Stokes",
        "Surry" => "Surry",
        "Swain" => "Swain",
        "Transylvania" => "Transylvania",
        "Tyrrell" => "Tyrrell",
        "Union" => "Union",
        "Vance" => "Vance",
        "Wake" => "Wake",
        "Warren" => "Warren",
        "Washington" => "Washington",
        "Watauga" => "Watauga",
        "Wayne" => "Wayne",
        "Wilkes" => "Wilkes",
        "Wilson" => "Wilson",
        "Yadkin" => "Yadkin",
        "Yancey" => "Yancey"
    ];
    public static $coverTypes = [
        null => null,
        "Open" => "Open",
        "Forest" => "Forest",
        "Developed" => "Developed",
        "Trail" => "Trail"
    ];
    public static $siteStatus = [
        null => null,
        'Available' => "Available",
        "Reserved" => "Reserved",
    ];
    public static $constants = [
        'baseurl' => 'http://localhost:5000',
        'baseadminurl' => 'http://localhost:5000/admin',
        'baseliburl' => 'http://localhost:5000/librarian'
    ];
    public static $uploadedStatus = [
        null => null,
        'Yes' => 'Yes',
        'No' => 'No',
        'Partial' => 'Partial',
        'Rejected' => 'Rejected',
        'Removed' => 'Removed'
    ];
    public static $siteDescriptionStatus = [
        null => 'All',
        'Yes' => 'Yes',
        'No' => 'No',
        'Partial' => 'Partial',
        'Rejected' => 'Rejected',
        'Removed' => 'Removed'
    ];
    public static $deploymentSetStatus = [
        null => null,
        'Yes' => 'Yes',
        'No' => 'No',
        'Partial' => 'Partial',
        'Rejected' => 'Rejected',
        'Removed' => 'Removed'
    ];
}
