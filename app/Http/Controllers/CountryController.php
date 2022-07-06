<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Country::withTrashed()->orderBy('name')->get();
    }

    public function available()
    {
        $countries = collect([]);
        $countries_registered = Country::withTrashed()->withoutTimestamp()->get();

        collect(countries(true))->each(function ($country) use ($countries_registered, &$countries) {
            $continent = array_key_first($country['geo']['continent']);

            //Only north and south america
            if ($continent == 'NA' || $continent == 'SA') {

                //Extract values from the country data collection
                $name = current($country['name']['native']);
                $currency = is_array($country['currency']) && count($country['currency']) > 0 ? current($country['currency'])['iso_4217_code'] : '';
                $calling_code = array_key_exists(0, $country['dialling']['calling_code']) ? current($country['dialling']['calling_code']) : '';

                //Validate that the country is not registered
                $country_registered = $countries_registered->filter(function ($item) use ($country) {
                    return $item->code_iso == $country['iso_3166_1_alpha2'];
                })->count();

                if (! $country_registered) {
                    $code = strtolower($country['iso_3166_1_alpha2']);
                    $data = country($code);
                    $flag = $data->getFlag();
                    $timezones = $data->getTimezones();

                    //Create flag if does not exist
                    $url_svg = 'flags/'.$code.'.svg';
                    if (! Storage::disk('public')->exists($url_svg)) {
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
     * Store a newly created resource in storage.
     *
     * @param  StoreCountryRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCountryRequest $request): JsonResponse
    {
        $country = Country::create([
            'name' => $request->country['name'],
            'capital' => $request->country['capital'],
            'code_iso' => $request->country['code_iso'],
            'code_iso3' => $request->country['code_iso3'],
            'currency' => $request->country['currency'],
            'calling_code' => $request->country['calling_code'],
            'flag_url' => $request->country['flag_url'],
        ]);

        $country->status = $request->status['id'];
        $country->save();

        return response()->json(__('notification.created', ['attribute' => 'country']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Country  $country
     * @return Response|Country
     */
    public function show(Country $country): Response|Country
    {
        return $country;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Country  $country
     * @return Response|Country
     */
    public function edit(Country $country): Response|Country
    {
        return $country;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCountryRequest  $request
     * @param  Country  $country
     * @return JsonResponse
     */
    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {
        if ($request->status['id'] == 'active') {
            if ($country->trashed()) {
                $country->restore();
            }
        } else {
            $country->delete();
        }
        $country->update($request->country);
        $country->status = $request->status['id'];
        $country->save();

        return response()->json(__('notification.updated', ['attribute' => 'country']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Country  $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        $country->delete();
        $country->status = 'inactive';
        $country->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'country']));
    }
}
