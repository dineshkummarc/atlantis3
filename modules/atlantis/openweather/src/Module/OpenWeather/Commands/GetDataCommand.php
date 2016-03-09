<?php

namespace Module\OpenWeather\Commands;

use Illuminate\Console\Command;
use Module\OpenWeather\Helpers\Data;

class GetDataCommand extends Command {

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $name = "Download new data from OpenWeather API";
  protected $signature = 'openweather:getdata';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'This command will download new weather data from OpenWeather API';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle() {

    Data::saveNew();

    $this->info('Data downloaded');
  }

}
