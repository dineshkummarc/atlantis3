<?php

namespace Module\OpenWeather\Controllers\Admin;

use Atlantis\Controllers\Admin\AdminModulesController;
use Illuminate\Http\Request;
use Module\OpenWeather\Models\Repositories\OpenWeatherRepository;
use Module\OpenWeather\Models\Repositories\OpenWeatherCitiesRepository;

class OpenWeatherAdminController extends AdminModulesController {

  public function __construct() {
    parent::__construct(\Config::get('openweather.setup'));   
  }

  public function getIndex($id = null) {  
    
    $aData = array();

    if (\Session::get('info') != NULL) {
      $aData['msgInfo'] = \Session::get('info');
    }

    if (\Session::get('success') != NULL) {
      $aData['msgSuccess'] = \Session::get('success');
    }

    if (\Session::get('error') != NULL) {
      $aData['msgError'] = \Session::get('error');
    }

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

    return view("openweather-admin::admin/openweather", $aData);
  }

  public function postAddId(Request $request) {

    OpenWeatherRepository::add($request->all());

    return redirect('admin/modules/openweather')->with('success', 'Updated');
  }

  public function postAddCity(Request $request) {

    OpenWeatherCitiesRepository::addCityID($request->get('id'));

    return redirect('admin/modules/openweather')->with('success', 'Updated');
  }

}
