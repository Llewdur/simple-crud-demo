@foreach($languages as $language)
    <option value="{{ $language->id }}">{{ $language->name }}</option>
@endforeach
