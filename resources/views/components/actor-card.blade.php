@props(['actor'])
<div class="mt-8">
    <a href="#">
        <img src="{{ $actor['profile_path'] }}" alt="parasite" class="rounded-2xl hover:opacity-75 transition ease-in-out">
    </a>
    <div class="mt-2">
        <a href="#" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
        <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
    </div>
</div>
