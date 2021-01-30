@foreach($interests as $interest)
    <option value="{{ $interest->id }}">{{ $interest->name }}</option>
@endforeach
