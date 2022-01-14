<tr>
<td class="header">
<a href="https://daeem.ma/" style="display: inline-block;">
@if (trim($slot) === 'Daeem')
<img src="{{ asset('assets/img/brand/daeem_blue.png')}}" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
