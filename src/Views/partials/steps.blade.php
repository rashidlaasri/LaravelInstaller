<ul class="steps-list">
  
  <li class="step-item {{ isActive('LaravelInstaller::welcome') }}">
    @if(Request::is('install') || Request::is('install/requirements') || Request::is('install/permissions') || Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
      <a href="{{ route('LaravelInstaller::welcome') }}">
        Get started
      </a>
    @else
      Get started
    @endif
  </li>
  
  <li class="step-item {{ isActive('LaravelInstaller::requirements') }}">
    @if(Request::is('install') || Request::is('install/requirements') || Request::is('install/permissions') || Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
    <a href="{{ route('LaravelInstaller::requirements') }}">
      Requirements
    </a>
    @else
    Requirements
    @endif
  </li>
  
  <li class="step-item {{ isActive('LaravelInstaller::permissions') }}">
    @if(Request::is('install/permissions') || Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
    <a href="{{ route('LaravelInstaller::permissions') }}">
      Permissions
    </a>
    @else
    Permissions
    @endif
  </li>
  
  <li class="step-item {{ isActive('LaravelInstaller::environment')}} {{ isActive('LaravelInstaller::environmentWizard')}} {{ isActive('LaravelInstaller::environmentClassic')}}">
    @if(Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
    <a href="{{ route('LaravelInstaller::environment') }}">
      Environment
    </a>
    @else
    Environment
    @endif
  </li>
  
  <li class="step-item {{ isActive('LaravelInstaller::final') }}">
    Summary
  </li>
  
</ul>
