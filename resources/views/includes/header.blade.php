<nav class="p-3 border-gray-200 rounded bg-gray-50 dark:bg-gray-800 dark:border-gray-700 w-screen left-0 right-0">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="{{ url('') }}" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-10" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Return home</span>
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                <ul class="flex flex-col mt-4 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                    <a href="{{ url('scans') }}" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Show Scans</span>
                    </a>
                </ul>
            </div>
        </div>
</nav>

