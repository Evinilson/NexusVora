@php
  $tone = $plan['tone'] ?? '#00D4FF';
  $isPopular = ! empty($plan['popular']);
@endphp

<div class="plan-card fade-up @if($isPopular) popular @endif">
  @if($isPopular)
    <div class="popular-badge">Mais popular</div>
  @endif

  <div class="plan-name">{{ $plan['name'] }}</div>
  <div class="plan-price-wrap">
    <div class="plan-old-price">{{ $plan['old'] }} <span class="plan-discount-badge">{{ $plan['discount'] }}</span></div>
    <div class="plan-price"><sup>€</sup>{{ $plan['price'] }}@if(! empty($plan['suffix']))<span class="plan-price-suffix">{{ $plan['suffix'] }}</span>@endif</div>
  </div>

  <p class="plan-desc">{{ $plan['desc'] }}</p>

  @if(! empty($plan['bonus']))
    <div class="site-bonus">
      <div class="site-bonus-label">Bónus: Site incluído</div>
      <div class="site-bonus-content">
        <span class="site-bonus-name">{{ $plan['bonus'][0] }}</span>
        <span><span class="site-bonus-old">{{ $plan['bonus'][1] }}</span><span class="site-bonus-val price-grad">Grátis</span></span>
      </div>
    </div>
  @endif

  <div class="plan-includes">O que inclui</div>
  <ul class="plan-features">
    @foreach ($plan['features'] as $feature)
      <li>@include('partials.pricing-check', ['tone' => $tone]) {{ $feature }}</li>
    @endforeach
  </ul>

  <a href="{{ route('contacto', ['plano' => $plan['slug'], 'categoria' => $plan['category']]) }}" class="plan-cta @if(! $isPopular) ghost @endif">Começar agora @include('partials.pricing-arrow')</a>
</div>
