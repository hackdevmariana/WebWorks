@php
$variables = $variables ?? [];
@endphp

:root {
@foreach ($variables as $variable)
  --{{ $variable->key }}: {{ $variable->value }};
@endforeach
}
