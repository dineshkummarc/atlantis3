<table>
     @foreach (array_keys($post) as $field_name)
        @if ($field_name != '_token' && $field_name != 'g-recaptcha-response')
            @if (is_array($post[$field_name]))
                <tr>
                    <td>{{ $field_name }}: </td>
                    <td>{{ implode(', ', $post[$field_name]) }}</td>
                </tr>
            @else
                <tr>
                    <td>{{ $field_name }}: </td>
                    <td>{{ $post[$field_name] }}</td>
                </tr>
            @endif
        @endif
    @endforeach
</table>
