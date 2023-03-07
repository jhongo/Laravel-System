
<x-layouts.app>

    <x-slot name="title">
        Home Title
    </x-slot>

    <h1 class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500" >Home</h1>

    @auth
        <div class="my-4 font-serif text-3xl text-center text-sky-600 dark:text-sky-500" >
            <label for=""> Welcome </label>
            {{ Auth::user()->name }}
        </div>        
    @endauth

</x-layouts.app>
