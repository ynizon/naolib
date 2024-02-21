<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 page-info">
                    <div class="row p-6">
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900">Créez vous un compte</h2>

                            <p>
                                En ayant un compte, vous pourrez mémorisez vos préférences d'alarmes (X minutes en avance),
                                mémorisez vos stations en favoris pour les avoir toujours sous la main...
                            </p>
                            @auth
                                <a class="ml-4 font-semibold" href="{{route("profile.edit")}}">Voir mes préférences</a>
                            @else
                                <a href="{{ route('login') }}" class="ml-4 font-semibold">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-semibold">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="row p-6">
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900">Suivi temps réél</h2>

                            <p>
                                Activez le voyant <i class="fa fa-location-pin-lock icon_footer active"></i> pour visualiser automatiquement les arrêts les plus proches et leurs horaires.
                                <br/>Le voyant <i class="fa fa-bell"></i> vous permet de placer des alarmes sur vos lignes.
                            </p>
                        </div>
                    </div>

                    <div class="row p-6">
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64" />
                            </svg>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900">Gagnez du temps</h2>

                            <p>
                                Tout est fait pour aller au plus vite. Si vous imaginez une solution plus rapide, alors contactez moi par email: <a href="mailto:ynizon@gmail.com">ynizon@gmail.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="row p-6">
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900">Evitez les retards</h2>

                            <p>
                                Soyez prévenus par email des retards sur vos lignes préférées
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

