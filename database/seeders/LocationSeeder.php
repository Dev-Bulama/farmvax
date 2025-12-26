<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\Lga;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Create Nigeria
        $nigeria = Country::create([
            'name' => 'Nigeria',
            'code' => 'NG'
        ]);

        // Nigerian States with some LGAs
        $statesData = [
            'Kano' => ['Kano Municipal', 'Nassarawa', 'Fagge', 'Dala', 'Gwale', 'Tarauni', 'Ungogo', 'Kumbotso'],
            'Lagos' => ['Lagos Island', 'Ikeja', 'Surulere', 'Eti-Osa', 'Lagos Mainland', 'Alimosho', 'Oshodi-Isolo'],
            'Kaduna' => ['Kaduna North', 'Kaduna South', 'Chikun', 'Igabi', 'Zaria', 'Sabon Gari', 'Giwa'],
            'Oyo' => ['Ibadan North', 'Ibadan South-West', 'Ibadan South-East', 'Ogbomosho North', 'Oyo East'],
            'Rivers' => ['Port Harcourt', 'Obio/Akpor', 'Eleme', 'Ikwerre', 'Emohua', 'Degema'],
            'Abuja (FCT)' => ['Abuja Municipal', 'Gwagwalada', 'Kuje', 'Bwari', 'Abaji', 'Kwali'],
            'Ogun' => ['Abeokuta South', 'Abeokuta North', 'Ado-Odo/Ota', 'Ijebu Ode', 'Sagamu'],
            'Katsina' => ['Katsina', 'Daura', 'Funtua', 'Malumfashi', 'Kankia', 'Dutsin-Ma'],
            'Anambra' => ['Awka North', 'Awka South', 'Onitsha North', 'Onitsha South', 'Nnewi North'],
            'Borno' => ['Maiduguri', 'Jere', 'Konduga', 'Bama', 'Biu', 'Gwoza'],
            'Delta' => ['Warri North', 'Warri South', 'Sapele', 'Ughelli North', 'Ughelli South'],
            'Edo' => ['Benin City', 'Oredo', 'Egor', 'Ikpoba Okha', 'Ovia North-East'],
            'Enugu' => ['Enugu North', 'Enugu South', 'Enugu East', 'Nsukka', 'Udi'],
            'Jigawa' => ['Dutse', 'Hadejia', 'Gumel', 'Kazaure', 'Ringim'],
            'Kebbi' => ['Birnin Kebbi', 'Argungu', 'Yauri', 'Zuru', 'Gwandu'],
            'Kogi' => ['Lokoja', 'Kabba/Bunu', 'Ijumu', 'Yagba East', 'Okene'],
            'Kwara' => ['Ilorin South', 'Ilorin West', 'Ilorin East', 'Asa', 'Moro'],
            'Nasarawa' => ['Lafia', 'Keffi', 'Nasarawa', 'Akwanga', 'Doma'],
            'Niger' => ['Minna', 'Bida', 'Kontagora', 'Suleja', 'Lapai'],
            'Osun' => ['Osogbo', 'Ife Central', 'Ife East', 'Ila', 'Ilesha East'],
            'Plateau' => ['Jos North', 'Jos South', 'Jos East', 'Barkin Ladi', 'Pankshin'],
            'Sokoto' => ['Sokoto North', 'Sokoto South', 'Wamako', 'Bodinga', 'Dange Shuni'],
            'Taraba' => ['Jalingo', 'Wukari', 'Bali', 'Gassol', 'Ibi'],
            'Yobe' => ['Damaturu', 'Potiskum', 'Gashua', 'Nguru', 'Geidam'],
            'Zamfara' => ['Gusau', 'Kaura Namoda', 'Talata Mafara', 'Bungudu', 'Maru'],
            'Adamawa' => ['Yola North', 'Yola South', 'Mubi North', 'Mubi South', 'Numan'],
            'Akwa Ibom' => ['Uyo', 'Eket', 'Ikot Ekpene', 'Oron', 'Abak'],
            'Bauchi' => ['Bauchi', 'Azare', 'Misau', 'Katagum', 'Jamaare'],
            'Bayelsa' => ['Yenagoa', 'Brass', 'Sagbama', 'Southern Ijaw', 'Ogbia'],
            'Benue' => ['Makurdi', 'Gboko', 'Otukpo', 'Katsina-Ala', 'Vandeikya'],
            'Cross River' => ['Calabar Municipal', 'Calabar South', 'Ikom', 'Ogoja', 'Obudu'],
            'Ebonyi' => ['Abakaliki', 'Afikpo North', 'Afikpo South', 'Ebonyi', 'Ezza North'],
            'Ekiti' => ['Ado-Ekiti', 'Ikere', 'Oye', 'Ilejemeje', 'Efon'],
            'Gombe' => ['Gombe', 'Kumo', 'Dukku', 'Billiri', 'Kaltungo'],
            'Imo' => ['Owerri Municipal', 'Owerri North', 'Orlu', 'Okigwe', 'Mbaitoli'],
            'Ondo' => ['Akure North', 'Akure South', 'Ondo East', 'Ondo West', 'Owo'],
        ];

        foreach ($statesData as $stateName => $lgas) {
            $state = State::create([
                'country_id' => $nigeria->id,
                'name' => $stateName,
                'code' => strtoupper(substr($stateName, 0, 2))
            ]);

            foreach ($lgas as $lgaName) {
                Lga::create([
                    'state_id' => $state->id,
                    'name' => $lgaName
                ]);
            }
        }

        // Add other countries
        $otherCountries = [
            ['name' => 'Ghana', 'code' => 'GH'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
        ];

        foreach ($otherCountries as $country) {
            Country::create($country);
        }
    }
}
