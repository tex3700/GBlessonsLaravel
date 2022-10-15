@php
    $message = $type = null;

	if (session()->has('success')) {
		$message = session()->get('success');
		$type = 'success';
	}

	if (session()->has('error')) {
		$message = session()->get('error');
		$type = 'danger';
	}

@endphp

@if($type !== null && $message !== null)
    <div class="alert alert-danger">
        <span type="{{$type}}" >"{{$message}}"</span>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p style="margin-bottom: 0;">{{ $error }}</p>
        @endforeach
    </div>
@endif
