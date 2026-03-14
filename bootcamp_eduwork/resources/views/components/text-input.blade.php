@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 rounded-md shadow-sm']) }} style="--tw-ring-color: #A29BFE;" onfocus="this.style.borderColor='#6C5CE7'" onblur="this.style.borderColor='#d1d5db'">
