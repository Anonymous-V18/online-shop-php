@php
  use App\Models\Province;
  use App\Models\District;
  use App\Models\Ward;

  $required   = $required ?? false;
  $prefix     = $prefix ?? null;
  $n = function($name) use ($prefix) { return $prefix ? "{$prefix}[{$name}]" : $name; };

  if (!isset($provinceId) && isset($model)) { $provinceId = data_get($model, 'province_id'); }
  if (!isset($districtId) && isset($model)) { $districtId = data_get($model, 'district_id'); }
  if (!isset($wardId)     && isset($model)) { $wardId     = data_get($model, 'ward_id'); }
  if (!isset($addressLine) && isset($model)) { $addressLine = data_get($model, 'address_line'); }

  $provinceId = $provinceId ?? old('province_id');
  $districtId = $districtId ?? old('district_id');
  $wardId     = $wardId     ?? old('ward_id');
  $addressLine= $addressLine?? old('address_line');

  $provinces = Province::query()->orderBy('name')->get(['id','name']);
  $districts = $provinceId ? District::query()->where('province_id', $provinceId)->orderBy('name')->get(['id','name']) : collect();
  $wards     = $districtId ? Ward::query()->where('district_id', $districtId)->orderBy('name')->get(['id','name']) : collect();
@endphp

<script>window.APP_API = window.APP_API || @json(url('/api'));</script>

<div class="row g-2" data-address-picker
     data-initial-province="{{ $provinceId ?? '' }}"
     data-initial-district="{{ $districtId ?? '' }}"
     data-initial-ward="{{ $wardId ?? '' }}">
  <div class="col-md-4">
    <label class="form-label">Tỉnh/Thành phố @if($required)<span class="text-danger">*</span>@endif</label>
    <select class="form-select" name="{{ $n('province_id') }}" @if($required) required @endif data-selected="{{ $provinceId }}">
      <option value="">Chọn tỉnh/thành...</option>
      @foreach($provinces as $p)
        <option value="{{ $p->id }}" @selected((string)$provinceId === (string)$p->id)>{{ $p->name }}</option>
      @endforeach
    </select>
    {{-- Mirror hidden placed AFTER select to override any earlier hidden input with value=1 --}}
    <input type="hidden" name="{{ $n('province_id') }}" value="{{ $provinceId }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">Quận/Huyện @if($required)<span class="text-danger">*</span>@endif</label>
    <select class="form-select" name="{{ $n('district_id') }}" @if($required) required @endif data-selected="{{ $districtId }}">
      <option value="">Chọn quận/huyện...</option>
      @foreach($districts as $d)
        <option value="{{ $d->id }}" @selected((string)$districtId === (string)$d->id)>{{ $d->name }}</option>
      @endforeach
    </select>
    <input type="hidden" name="{{ $n('district_id') }}" value="{{ $districtId }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">Phường/Xã @if($required)<span class="text-danger">*</span>@endif</label>
    <select class="form-select" name="{{ $n('ward_id') }}" @if($required) required @endif data-selected="{{ $wardId }}">
      <option value="">Chọn phường/xã...</option>
      @foreach($wards as $w)
        <option value="{{ $w->id }}" @selected((string)$wardId === (string)$w->id)>{{ $w->name }}</option>
      @endforeach
    </select>
    <input type="hidden" name="{{ $n('ward_id') }}" value="{{ $wardId }}">
  </div>
  <div class="col-12">
    <label class="form-label mt-2">Địa chỉ (Số nhà, đường) @if($required)<span class="text-danger">*</span>@endif</label>
    <input type="text" class="form-control" name="{{ $n('address_line') }}" value="{{ $addressLine ?? '' }}" placeholder="VD: 123 Lê Lợi, Phường 7" @if($required) required @endif>
  </div>
</div>

<script>
(function(){
  function boot(){ 
    if (window.AddressPicker && typeof window.AddressPicker.refresh==='function'){ 
      window.AddressPicker.refresh(); 
      // sync mirrors once now
      document.querySelectorAll('[data-address-picker]').forEach(function(c){
        ['province_id','district_id','ward_id'].forEach(function(k){
          var sel=c.querySelector('select[name$="['+k+']"], select[name="'+k+'"]');
          var hid=c.querySelector('input[type="hidden"][name$="['+k+']"], input[type="hidden"][name="'+k+'"]');
          if(sel && hid){ hid.value = sel.value || ''; sel.addEventListener('change', function(){ hid.value = sel.value || ''; }); }
        });
      });
      return true; 
    } 
    return false; 
  }
  if (!boot()){
    var s=document.createElement('script');
    s.src='{{ asset('js/address-picker.js') }}';
    s.onload=boot; document.head.appendChild(s);
  }
})();
</script>
