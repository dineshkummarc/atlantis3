<div class="weather-widget">
  @if (!isset($error))
  <h3>{{ $oData->name }}, {{ $oData->sys->country }}</h3>
  <h2> <img src="http://openweathermap.org/img/w/{{ $oData->weather[0]->icon }}.png"> {{ $temp }}</h2>
  {{ $oData->weather[0]->main }}, {{ $oData->weather[0]->description }}
  <p>
    <span id="date_m">get at 0000.00.00 00:00</span>
  </p>

  <table class="table table-striped table-bordered table-condensed">
    <tbody>

      <tr><td>Wind</td><td>{{ $oData->wind->speed }} m/s</td></tr>

      <tr><td>Cloudiness</td><td>{{ $oData->clouds->all }} %</td></tr>

      <tr><td>Pressure<br></td><td>{{ $oData->main->pressure }} hpa</td></tr>

      <tr><td>Humidity</td><td>{{ $oData->main->humidity }} %</td></tr>

      <tr><td>Sunrise</td><td id="sunrise">00:00</td></tr>

      <tr><td>Sunset</td><td id="sunset">00:00</td></tr>
    </tbody>
  </table>

  <script type="text/javascript">

    var dt = new Date({{ $oData->dt }} * 1000);
    var hr = dt.getHours();
    if (hr < 10)
            hr = '0' + hr;
    var mn = dt.getMinutes();
    if (mn < 10)
            mn = '0' + mn;
    var mon = dt.getMonth() + 1;
    if (mon < 10)
            mon = '0' + mon;
    var day = dt.getDate();
    if (day < 10)
            day = '0' + day;
    var year = dt.getFullYear();
    $("#date_m").html('get at ' + year + '.' + mon + '.' + day + ' ' + hr + ':' + mn);
    var dt = new Date({{ $oData->sys->sunrise }} * 1000);
    var hr = dt.getHours();
    if (hr < 10)
            hr = '0' + hr;
    var mn = dt.getMinutes();
    if (mn < 10)
            mn = '0' + mn;
    $("#sunrise").html(hr + ':' + mn);
    var dt = new Date({{ $oData->sys->sunset }} * 1000);
    var hr = dt.getHours();
    if (hr < 10)
            hr = '0' + hr;
    var mn = dt.getMinutes();
    if (mn < 10)
            mn = '0' + mn;
    $("#sunset").html(hr + ':' + mn);
  </script>

  @else
  <div class="weahter-error">{{ $error }}</p>
    @endif
  </div>
</div>