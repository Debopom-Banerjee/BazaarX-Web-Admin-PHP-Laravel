<?php 
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\CanManageFiles;
use App\Traits\CanSendFCMNotification;
use App\Traits\HasResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CanManageFiles, HasResponse, CanSendFCMNotification;
    
    protected $resultLimit = 10;

    public function __construct() {
        session()->put('app', request()->get('ref'));
    }
}
