<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\LandingPageSection;
use App\Models\Plan;
use App\Models\Utility;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $businessDetail = Business::get();
        $businessCounts = Business::select('business_category', DB::raw('COUNT(*) as count'))
            ->groupBy('business_category')
            ->get();
        $categoryData = BusinessCategory::get();
        $categoryData = $categoryData->map(function ($category) use ($businessCounts) {
            $category->count = $businessCounts->where('business_category', $category->id)->first()->count ?? 0;
            return $category;
        });
        return view('landingpage::marketplace.index', compact('categoryData', 'businessDetail'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('landingpage::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('landingpage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('landingpage::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('search-business');
        $businessDetail = Business::where('title', 'like', "%$query%")->get();

        $businessCounts = Business::select('business_category', DB::raw('COUNT(*) as count'))
            ->groupBy('business_category')
            ->get();
        $categoryData = BusinessCategory::get();
        $categoryData = $categoryData->map(function ($category) use ($businessCounts) {
            $category->count = $businessCounts->where('business_category', $category->id)->first()->count ?? 0;
            return $category;
        });
        return view('landingpage::marketplace.index', compact('businessDetail', 'categoryData'));
    }
    public function landingHome()
    {
        if (!file_exists(storage_path() . "/installed")) {
            header('location:install');
            die;
        } else {
            $settings = Utility::settings();
            if ($settings['display_landing_page'] == 'on' && \Schema::hasTable('landing_page_settings')) {
                $plans = Plan::get();
                $get_section = LandingPageSection::orderBy('section_order', 'ASC')->get();
                return view('landingpage::layouts.landingpage', compact('plans', 'get_section'));
            }
            else
            {
                return redirect()->route('login');
            }
        }
    }
}
