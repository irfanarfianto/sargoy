<x-error-layout>
    <div class="flex items-center justify-center min-h-screen bg-indigo-500 bg-fixed bg-cover bg-bottom error-bg"
        style="background-image: url(data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23f0b608' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23e6d710' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23e7af05' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23e7d808' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23d8a408' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23f1e213' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23f0b607' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23e4d506' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23eab822' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%23e8da14' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23e8b008' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23edde14' points='943 900 1210 900 971 687'/%3E%3C/svg%3E);">

        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center text-gray-50 text-center">
                <div class="relative mt-10 md:mt-20 lg:mt-32">
                    <h1 class="text-7xl md:text-9xl tracking-tighter-less text-shadow font-sans font-bold">
                        <span>4</span><span>0</span><span>3</span>
                    </h1>
                    <span class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-6 text-gray-300 font-semibold">Oops!</span>
                </div>
                <h5 class="text-gray-300 font-semibold mt-4">Page not found</h5>
                <p class="text-gray-100 mt-2 mb-6 px-4">{{ $exception }}</p>

                <a href="/" class="bg-green-400 px-5 py-3 text-sm shadow-sm font-medium tracking-wider text-gray-50 rounded-full hover:shadow-lg">
                    Go to Home
                </a>
            </div>
        </div>
    </div>

    <style>
        .error-bg {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23f0b608' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23e6d710' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23e7af05' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23e7d808' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23d8a408' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23f1e213' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23f0b607' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23e4d506' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23eab822' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%23e8da14' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23e8b008' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23edde14' points='943 900 1210 900 971 687'/%3E%3C/svg%3E");
        }

        .tracking-tighter-less {
            letter-spacing: -0.75rem;
        }

        .text-shadow {
            text-shadow: -8px 0 0 rgb(102 123 242);
        }
    </style>
</x-error-layout>
