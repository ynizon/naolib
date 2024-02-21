<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            Durée avant alarme (en minutes) :
            <select name="pref_alarm" class="form-control" >
                @for ($i = 1; $i <= 20; $i++)
                    <option value="{{$i}}" @if($i == Auth::user()->pref_alarm) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>

        <div>
            Sélectionnez les lignes que vous empruntez le plus :
            <br/>
            <select class="form-control" name="ligne_bus[]" multiple size="20">
                <option @if(in_array("XXX",$tabLignes)) selected @endif value="XXX">Aucune</option>
                <optgroup label="Chronobus">
                    @for ($i = 1; $i < 10; $i++)
                        <option value="C{{$i}}" @if(in_array("C".$i,$tabLignes)) selected @endif>C{{$i}}</option>
                    @endfor
                </optgroup>
                <optgroup label="Lignes Express">
                    @for ($i = 1; $i < 10; $i++)
                        <option value="E{{$i}}" @if(in_array("E".$i,$tabLignes)) selected @endif>E{{$i}}</option>
                    @endfor
                </optgroup>
                <optgroup label="Bus et tramways">
                    @for ($i = 1; $i < 100; $i++)
                        <option value="{{$i}}" @if(in_array($i,$tabLignes)) selected @endif>{{$i}}</option>
                    @endfor
                </optgroup>
            </select>
        </div>

        <div>
            Etre alerté des perturbations les : <br/>
            <select name="jours[]" id="jours[]" multiple style="height:140px;" class="form-control">
                @for ($iJour = 0; $iJour <7; $iJour++)
                    <option @if (in_array($iJour,$tabJours)) selected  @endif value="{{$iJour}}">
                    @php
                        switch ($iJour){
                            case 1:
                                echo "Lundi";
                                break;
                            case 2:
                                echo "Mardi";
                                break;
                            case 3:
                                echo "Mercredi";
                                break;
                            case 4:
                                echo "Jeudi";
                                break;
                            case 5:
                                echo "Vendredi";
                                break;
                            case 6:
                                echo "Samedi";
                                break;
                            case 0:
                                echo "Dimanche";
                                break;
                        }
                    @endphp
                    </option>
                @endfor
            </select>
            <br/>(utilisez la touche control pour en sélectionner plusieurs)
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
