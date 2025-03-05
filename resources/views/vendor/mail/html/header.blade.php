props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Polymer Logo">
@else
{{-- {{ $slot }} --}}
<img src="{{ asset('img/logo-blanco_vs02.svg') }}" class="logo" alt="Polymer - Logo">
@endif
</a>
</td>
</tr>

