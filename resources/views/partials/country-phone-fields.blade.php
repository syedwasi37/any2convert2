@php
    $countryFieldId = $fieldPrefix.'-country';
    $phoneFieldId = $fieldPrefix.'-phone';
    $selectedCountry = $selectedCountry ?? '';
    $phoneValue = $phoneValue ?? '';
    $required = $required ?? false;
@endphp
<div class="field">
    <label for="{{ $countryFieldId }}">Country</label>
    <select id="{{ $countryFieldId }}" name="country_code" data-country-select @required($required)>
        <option value="">Choose your country</option>
        @foreach ($countries as $country)
            <option value="{{ $country['code'] }}" data-dial="{{ $country['dial'] }}" @selected($selectedCountry === $country['code'])>{{ $country['flag'] }} {{ $country['name'] }} ({{ $country['dial'] }})</option>
        @endforeach
    </select>
    @error('country_code')<p class="error-text">{{ $message }}</p>@enderror
</div>
<div class="field">
    <label for="{{ $phoneFieldId }}">Phone number</label>
    <div class="phone-wrap"><span data-phone-prefix>{{ collect($countries)->firstWhere('code', $selectedCountry)['dial'] ?? 'Code' }}</span><input id="{{ $phoneFieldId }}" name="phone" type="tel" inputmode="tel" autocomplete="tel-national" value="{{ $phoneValue }}" placeholder="300 1234567" @required($required)></div>
    @error('phone')<p class="error-text">{{ $message }}</p>@enderror
</div>
