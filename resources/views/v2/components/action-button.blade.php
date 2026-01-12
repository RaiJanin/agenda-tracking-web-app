<div>
    <!-- Be present above all else. - Naval Ravikant -->
     <form action="{{ $action }}" method="POST" class="inline">
        @csrf
        @method($method)

        <button type="submit"
            class="{{ $class }}"
            >
            {{ $slot }}
        </button>
    </form>
</div>