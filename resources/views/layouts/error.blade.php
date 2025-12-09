@if ($errors->any())
    <div class="font-semibold mt-1 text-m text-gray-600 dark:text-gray-300">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif