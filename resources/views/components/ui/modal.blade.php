@props(['id'])

<div id="{{ $id }}" class="fixed inset-0 hidden items-center justify-center z-50">
    <div class="modal-overlay absolute inset-0 bg-black/50"></div>

    <div class="bg-white rounded-xl p-6 z-10 w-full max-w-lg">
        {{ $slot }}
    </div>
</div>