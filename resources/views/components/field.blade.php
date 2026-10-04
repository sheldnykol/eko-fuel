@props(['name', 'label', 'type' => 'text', 'hint' => null, 'upper' => false])

<div {{ $attributes->only('class') }}>
    <label for="{{ $name }}" class="mb-1 block text-[13px] font-medium text-slate-700">
        {{ $label }}
        @if ($hint)
            <span class="font-normal text-slate-400">{{ $hint }}</span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) }}"
        {{ $attributes->except('class')->merge(['class' => 'h-10 w-full rounded-lg border bg-white px-3 text-sm text-slate-900 focus:ring-1 focus:outline-none ' . ($errors->has($name) ? 'border-red-400 focus:border-red-500 focus:ring-red-500' : 'border-slate-300 focus:border-[#e21838] focus:ring-[#e21838]') . ($upper ? ' uppercase' : '')]) }}
    />
    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
