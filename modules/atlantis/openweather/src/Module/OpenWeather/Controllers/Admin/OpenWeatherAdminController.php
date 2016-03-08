<?php

namespace Module\OpenWeather\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\OpenWeather\Models\Repositories\OpenWeatherRepository;
use Module\OpenWeather\Models\Repositories\OpenWeatherCitiesRepository;

class OpenWeatherAdminController extends Controller {

  public function __construct() {

    $this->config = \Config::get('openweather.setup');

    $this->middleware('Atlantis\Middleware\AdminAuth');
    $this->middleware('Atlantis\Middleware\Permissions:' . $this->config['moduleNamespace'] . ','
            . 'Atlantis\Models\Repositories\RoleUsersRepository,'
            . 'Atlantis\Models\Repositories\PermissionsRepository');
  }

  public function getIndex($id = null) {

    $aData = array();

    $openWeather = OpenWeatherRepository::get();
    $openWeatherCities = OpenWeatherCitiesRepository::getCity();

    if ($openWeather != NULL) {
      $aData['app_id'] = $openWeather->app_id;
      if ($openWeather->temperature == 'F') {
        $aData['C'] = FALSE;
        $aData['F'] = TRUE;
      } else {
        $aData['C'] = TRUE;
        $aData['F'] = FALSE;
      }
    } else {
      $aData['app_id'] = NULL;
      $aData['C'] = TRUE;
      $aData['F'] = FALSE;
    }

    if ($openWeatherCities != NULL) {
      $aData['id'] = $openWeatherCities->id;
    } else {
      $aData['id'] = NULL;
    }

    return view("openweather::admin/openweather", $aData);
  }

  public function postAddId(Request $request) {

    OpenWeatherRepository::add($request->all());

    return redirect('admin/modules/openweather');
  }

  public function postAddCity(Request $request) {

    OpenWeatherCitiesRepository::addCityID($request->get('id'));

    return redirect('admin/modules/openweather');
  }

}
