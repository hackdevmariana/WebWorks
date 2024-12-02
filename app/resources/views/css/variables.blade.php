/* Font Imports */

@foreach ($cssFonts as $font)
@import url('{{ $font->import_url }}');
@endforeach


/* Colors */

:root {
@foreach ($cssVariables as $variable)
    {{ $variable->key }}: {{ $variable->value }};
@endforeach


/* Fonts */

@foreach ($cssFonts as $font)
    {{ $font->variable_name }}: '{{ $font->name }}', sans-serif;
@endforeach


/* Generals */

@foreach ($cssGenerals as $general)
    {{ $general->key }}: {{ $general->value }};
@endforeach
}


