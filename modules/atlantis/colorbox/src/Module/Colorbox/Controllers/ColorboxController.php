<?php

namespace Module\Colorbox\Controllers;

use Module\Colorbox\Models\Repositories\ColorboxRepository;
use Atlantis\Helpers\Media\MediaTools;

/*
 * Controller: Colorbox
 * @Atlantis CMS
 * v 1.0
 */
use App\Http\Controllers\Controller;

class ColorboxController extends Controller {

  public function __construct() {
    
    $assets_path = config('atlantis.modules_dir') . config('colorbox.setup.path') . '/Module/Colorbox/Assets/';
    
    \Atlantis\Helpers\Assets::registerScript('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', 10);
    \Atlantis\Helpers\Assets::registerScript($assets_path . 'js/jquery.colorbox.js', 20);
    
  }

  public function build($aParams = NULL) {    
    
    if (isset($aParams[0])) {

      $id = $aParams[0];

      $model = ColorboxRepository::getItem($id);

      if ($model != NULL) {
        $images = MediaTools::getImagesByGallery($model->gallery_id);
        
        $aData['images'] = $images;
        
        \Atlantis\Helpers\Assets::registerJS(view('colorbox::colorbox-script', $aData));
        return view('colorbox::colorbox', $aData);
      } else {
        abort(404, "colorbox with ID: " . $id . " not found");
      }
    } else {
      abort(404, 'form ID is missing');
    }

    return NULL;
  }

}
