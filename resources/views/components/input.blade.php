<div class="form-group">
  <label for="{{ $name }}" class="col-form-label">{{ $label }}</label>
  @if(isset($type) && $type == 'textarea') 
  <textarea class="form-control"  name="{{ $name }}" placeholder="Insert {{ $label }}" type="{{ isset($type) ? $type : 'text' }}" id="{{ $name }}">{{ isset($value) ? $value : '' }}</textarea>
  @else
  <input class="form-control" name="{{ $name }}"  placeholder="Insert {{ $label }}" type="{{ isset($type) ? $type : 'text' }}" value="{{ isset($value) ? $value : '' }}" id="{{ $name }}">
  @endif
</div>