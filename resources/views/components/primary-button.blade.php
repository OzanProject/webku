<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-4 py-3 bg-[#f97316] border border-transparent rounded-[12px] font-bold text-sm text-white tracking-wide hover:bg-[#ea580c] focus:bg-[#ea580c] active:bg-[#c2410c] focus:outline-none focus:ring-2 focus:ring-[#f97316] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg w-full']) }}>
    {{ $slot }}
</button>
