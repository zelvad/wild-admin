@props(['name'])

@error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
