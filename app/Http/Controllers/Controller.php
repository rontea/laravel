<?php
/**
 * @author: RonTea
 * Website: https://live-rontea.pantheonsite.io/
 * Version: 0
 * Date: June, 30, 2023
 * File: app\Http\Controllers\Controller.php
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
