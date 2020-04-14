<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    public static $signupFormIDs = [
        "1" => "Non-uploader Borrower",
        "2" => "Non-uploader BYO",
        "3" => "Uploader Borrower",
        "4" => "Uploader BYO",
    ];
    public static $signupTypeID = [
        "1" => [
            "uploader" => "0",
            "borrower" => "1",
            ],
        "2" => [
            "uploader" => "0",
            "borrower" => "0",
        ],
        "3" => [
            "uploader" => "1",
            "borrower" => "1",
        ],
        "4" => [
            "uploader" => "1",
            "borrower" => "0",
        ],
    ];
    public static $signupCameras = [
        "1" => "Borrower",
        "2" => "BYO"
    ];
    public static $signupUploads = [
        "1" => "Uploader",
        "2" => "Non-uploader"
    ];
    public static $siteDescriptionFormIDs = [
        "1" => "Non-uploader",
        "2" => "Uploader"
    ];
}
