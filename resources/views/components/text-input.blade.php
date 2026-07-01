@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#f97316] focus:ring-[#f97316] rounded-[12px] shadow-sm transition-colors duration-200']) }}>
