@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
switch ($align) {
case 'left':
$alignmentClasses = 'origin-top-left left-0';
break;
case 'top':
$alignmentClasses = 'origin-top';
break;
case 'right':
default:
$alignmentClasses = 'origin-top-right right-0';
break;
}

switch ($width) {
case '48':
$width = 'w-48';
break;
}
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>
</div>