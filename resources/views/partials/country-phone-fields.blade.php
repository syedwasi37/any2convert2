@php
    $countryFieldId = $fieldPrefix.'-country';
    $phoneFieldId = $fieldPrefix.'-phone';
    $selectedCountry = $selectedCountry ?? '';
    $phoneValue = $phoneValue ?? '';
    $required = $required ?? false;
    $sortedCountries = collect($countries)->sortBy('name')->values();
    $selectedCountryData = $sortedCountries->firstWhere('code', $selectedCountry);
@endphp
<div class="field country-field" data-country-picker>
    <label for="{{ $countryFieldId }}-search">Country</label>
    <div class="country-picker">
        <input id="{{ $countryFieldId }}-value" type="hidden" name="country_code" value="{{ $selectedCountry }}" data-country-value>
        <input id="{{ $countryFieldId }}-search" type="search" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="{{ $countryFieldId }}-list" autocomplete="off" placeholder="Search countries by name or first letter" value="{{ $selectedCountryData ? $selectedCountryData['flag'].' '.$selectedCountryData['name'].' ('.$selectedCountryData['dial'].')' : '' }}" data-country-search>
        <div class="country-menu" id="{{ $countryFieldId }}-list" role="listbox" hidden>
            <div class="country-letters" aria-label="Filter countries by first letter">
                @foreach (range('A', 'Z') as $letter)
                    @if ($sortedCountries->contains(fn ($country) => str_starts_with(strtoupper($country['name']), $letter)))
                        <button type="button" data-country-letter="{{ $letter }}" aria-label="Countries beginning with {{ $letter }}">{{ $letter }}</button>
                    @endif
                @endforeach
            </div>
            <div class="country-results" data-country-results>
                @foreach ($sortedCountries as $country)
                    <button type="button" role="option" aria-selected="{{ $selectedCountry === $country['code'] ? 'true' : 'false' }}" data-country-option data-code="{{ $country['code'] }}" data-name="{{ $country['name'] }}" data-dial="{{ $country['dial'] }}" data-flag="{{ $country['flag'] }}" data-placeholder="{{ \App\Support\CountryCatalog::phonePlaceholder($country['code']) }}">
                        <span>{{ $country['flag'] }} {{ $country['name'] }}</span><span class="country-dial">{{ $country['dial'] }}</span>
                    </button>
                @endforeach
                <p class="country-empty" data-country-empty hidden>No countries found.</p>
            </div>
        </div>
    </div>
    @error('country_code')<p class="error-text">{{ $message }}</p>@enderror
</div>
<div class="field">
    <label for="{{ $phoneFieldId }}">Phone number</label>
    <div class="phone-wrap"><span data-phone-prefix>{{ $selectedCountryData['dial'] ?? 'Code' }}</span><input id="{{ $phoneFieldId }}" name="phone" type="tel" inputmode="tel" autocomplete="tel-national" value="{{ $phoneValue }}" placeholder="{{ $selectedCountryData ? \App\Support\CountryCatalog::phonePlaceholder($selectedCountry) : 'Select a country first' }}" @required($required) data-phone-input></div>
    @error('phone')<p class="error-text">{{ $message }}</p>@enderror
</div>
<style>
.country-picker{position:relative}.country-picker>[data-country-search]{display:block;width:100%;height:47px;padding:0 12px;border:1px solid #dedfdb;border-radius:9px;background:#fff;color:inherit;font:inherit;font-size:14px}.country-menu{position:absolute;z-index:30;top:calc(100% + 5px);left:0;right:0;padding:8px;border:1px solid #e2e4df;border-radius:11px;background:#fff;box-shadow:0 12px 30px #202a201a}.country-menu[hidden],.country-results>[hidden]{display:none}.country-letters{display:flex;flex-wrap:wrap;gap:3px;padding:0 0 7px;border-bottom:1px solid #eceeea}.country-letters button{width:25px;height:25px;padding:0;border:0;border-radius:5px;background:#f4f6f2;color:#3e6248;font:inherit;font-size:10px;font-weight:700;cursor:pointer}.country-letters button:hover,.country-letters button:focus-visible{background:#dfece1}.country-results{max-height:230px;overflow:auto}.country-results>[data-country-option]{display:flex;width:100%;align-items:center;justify-content:space-between;gap:10px;padding:9px 8px;border:0;border-radius:6px;background:#fff;color:#202321;text-align:left;font:inherit;font-size:13px;cursor:pointer}.country-results>[data-country-option]:hover,.country-results>[data-country-option][aria-selected=true]{background:#f2f6f1}.country-dial{color:#68756a;font-size:12px;white-space:nowrap}.country-empty{padding:8px;color:#777;font-size:12px}.country-empty[hidden]{display:none}.phone-wrap{display:flex;align-items:center;height:47px;border:1px solid #dedfdb;border-radius:9px;overflow:hidden}.phone-wrap>span{height:100%;display:flex;align-items:center;padding:0 11px;border-right:1px solid #e8e9e4;color:#2f694e;font-size:13px;font-weight:700;white-space:nowrap}.phone-wrap input{height:45px;border:0;border-radius:0;min-width:0;flex:1}.country-picker>[data-country-search]:focus,.phone-wrap:focus-within{outline:2px solid #6a916d55;outline-offset:1px}@media(max-width:480px){.country-letters{gap:2px}.country-letters button{width:23px;height:24px}}
</style>
<script>
(() => {
    document.querySelectorAll('[data-country-picker]:not([data-picker-ready])').forEach((picker) => {
        picker.dataset.pickerReady = '1';
        const form = picker.closest('form');
        const search = picker.querySelector('[data-country-search]');
        const value = picker.querySelector('[data-country-value]');
        const menu = picker.querySelector('.country-menu');
        const results = picker.querySelector('[data-country-results]');
        const empty = picker.querySelector('[data-country-empty]');
        const options = [...picker.querySelectorAll('[data-country-option]')];
        const letters = [...picker.querySelectorAll('[data-country-letter]')];
        const phone = form?.querySelector('[data-phone-input]');
        const prefix = form?.querySelector('[data-phone-prefix]');
        const open = () => {
            menu.hidden = false;
            search.setAttribute('aria-expanded', 'true');
            const selected = options.find(option => option.dataset.code === value.value);
            filter(selected && search.value === `${selected.dataset.flag} ${selected.dataset.name} (${selected.dataset.dial})` ? '' : search.value);
        };
        const close = (restore = true) => {
            menu.hidden = true;
            search.setAttribute('aria-expanded', 'false');
            if (restore) {
                const selected = options.find(option => option.dataset.code === value.value);
                search.value = selected ? `${selected.dataset.flag} ${selected.dataset.name} (${selected.dataset.dial})` : '';
            }
        };
        const filter = (query) => {
            const term = (query || '').trim().toLocaleLowerCase();
            let count = 0;
            options.forEach(option => {
                const matches = !term || option.dataset.name.toLocaleLowerCase().startsWith(term) || option.dataset.code.toLocaleLowerCase().startsWith(term) || option.dataset.dial.startsWith(term);
                option.hidden = !matches;
                if (matches) count++;
            });
            empty.hidden = count > 0;
        };
        search.addEventListener('focus', () => { search.select(); open(); });
        search.addEventListener('click', open);
        search.addEventListener('input', () => { menu.hidden = false; search.setAttribute('aria-expanded', 'true'); filter(search.value); });
        search.addEventListener('keydown', (event) => { if (event.key === 'Escape') close(); });
        letters.forEach(button => button.addEventListener('click', () => { search.value = button.dataset.countryLetter; menu.hidden = false; search.setAttribute('aria-expanded', 'true'); filter(search.value); }));
        options.forEach(option => option.addEventListener('click', () => {
            value.value = option.dataset.code;
            options.forEach(item => item.setAttribute('aria-selected', item === option ? 'true' : 'false'));
            if (prefix) prefix.textContent = option.dataset.dial;
            if (phone) phone.placeholder = option.dataset.placeholder;
            close();
        }));
        document.addEventListener('click', event => { if (!picker.contains(event.target)) close(); });
        if (form) form.addEventListener('submit', event => {
            if (!value.value) { event.preventDefault(); search.setCustomValidity('Choose a country from the list.'); search.reportValidity(); }
            else search.setCustomValidity('');
        });
        search.addEventListener('input', () => search.setCustomValidity(''));
        const selected = options.find(option => option.dataset.code === value.value);
        if (selected) {
            if (prefix) prefix.textContent = selected.dataset.dial;
            if (phone) phone.placeholder = selected.dataset.placeholder;
        }
    });
})();
</script>
