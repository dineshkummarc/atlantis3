<div class="helper">
  <button type="button" class="icon icon-Bulb" data-panel-toggle="tips-panel"></button>
  <div class="right-panel side-panel" id="tips-panel" data-atlantis-panel>
    <ul class="accordion" data-accordion>
      <li class="accordion-item is-active" data-accordion-item>
        <a href="#" class="accordion-title">Redirect url</a>
        <div class="accordion-content" data-tab-content>
          <p>If you have added form on page with url "/index" and
            <br>REDIRECT URL "<?= '{{url}}/test' ?>". After submit will be redirected to "/index/test"
            <br>REDIRECT URL "<?= '/test' ?>". After submit will be redirected to "/test"</p>
        </div>
      </li>
      <li class="accordion-item" data-accordion-item>
        <a href="#" class="accordion-title">ex2</a>
        <div class="accordion-content" data-tab-content>
          
          <p>example</p>
        </div>
      </li>
    </ul>
  </div>
</div>