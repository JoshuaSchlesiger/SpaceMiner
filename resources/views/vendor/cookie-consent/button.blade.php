<form action="{!! $url !!}" {!! $attributes !!} method="POST">
    @csrf
    <button type="submit" class="{!! $basename !!}__link">
        <span class="{!! $basename !!}__label">{{ $label }}</span>
    </button>
</form>
