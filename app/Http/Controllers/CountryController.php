<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function available() {

        $countries = collect([]);
        $countries_registered = Country::withTrashed()->withoutTimestamp()->get();

        collect(countries(true))->each(function ($country) use ($countries_registered, &$countries) {

            $continent = array_key_first($country['geo']['continent']);

            //Only north and south america
            if ($continent == 'NA' || $continent == 'SA') {

                //Extract values from the country data collection
                $name = current($country['name']['native']);
                $currency = is_array($country['currency']) && sizeof($country['currency']) > 0 ? current($country['currency'])['iso_4217_code'] : '';
                $calling_code = array_key_exists(0, $country['dialling']['calling_code']) ? current($country['dialling']['calling_code']) : '';

                //Validate that the country is not registered
                $country_registered = $countries_registered->filter(function ($item) use ($country) {
                    return $item->code_iso == $country['iso_3166_1_alpha2'];
                })->count();


                if (!$country_registered) {

                    $code = strtolower($country['iso_3166_1_alpha2']);
                    $data = country($code);
                    $flag = $data->getFlag();
                    $timezones = $data->getTimezones();

                    //Create flag if does not exist
                    $url_svg = 'flags/'.$code.'.svg';
                    if (!Storage::disk('public')->exists($url_svg)) {
                        Storage::disk('public')->put($url_svg, $flag);
                    }
                    $flag_url = Storage::disk('public')->url($url_svg);

                    $countries->add([
                        'name' => $name['common'],
                        'capital' => $country['capital'],
                        'code_iso' => $country['iso_3166_1_alpha2'],
                        'code_iso3' => $country['iso_3166_1_alpha3'],
                        'currency' => $currency,
                        'calling_code' => $calling_code,
                        'flag_url' => $flag_url,
                        'timezones' => $timezones,
                    ]);
                }
            }
        });
        return $countries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCountryRequest $request
     * @return Response
     */
    public function store(StoreCountryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
