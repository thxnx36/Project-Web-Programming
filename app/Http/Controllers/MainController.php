<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Report;
use App\Models\RiskyPlace;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    function indexPage(ServerRequestInterface $request) {
        $current_date = date('Y-m-d');
        $query = Report::where('date', $current_date)->first();
        $reports = Report::orderBy('date', 'desc')->limit(15);
        $total_recovered = Report::sum('n_recovered');
        $total_patients = Report::sum('n_pmc') + Report::sum('n_prison') + Report::sum('n_ft');
        $total_death = Report::sum('n_death');

        $rd_count = District::orderBy('name')->withCount('places');
        return view('index', [
            'format_day' => $this->formatDate($current_date),
            'report' => $query,
            'reports' => $reports->paginate(5),
            'total_patients' => $total_patients,
            'total_recovered' => $total_recovered,
            'total_death' => $total_death,
            'rd_count' => $rd_count->get()
        ]);
    }

    function formatDate($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    function riskyPlace(ServerRequestInterface $request) {
        $data = $request->getParsedBody();
        $query = RiskyPlace::orderBy('id')->limit(10);
        $districts = District::all();
        $term = (empty($data['search']))? '' : $data['search'];
        foreach(preg_split('/\s+/', trim($term)) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('name', 'LIKE', "%{$word}%")
                    ->orWhere('description', 'LIKE', "%{$word}%")
                    ->orWhere('district_name', 'LIKE', "%{$word}%");
            });
        }
        return view('risky-place', [
            'locations' => $query->paginate(10),
            'districts' => $districts,
            'term' => $term
        ]);
    }

    ##Instert
    function addRiskyPlace(ServerRequestInterface $request) {
        $query = RiskyPlace::create($request->getParsedBody());
        return redirect()->route('manage-places')->with('added-place', 'Place added.');
    }

    #Update
    function updateRiskyPlace(ServerRequestInterface $request, $riskyPlaceId) {
        $query = RiskyPlace::where('id', $riskyPlaceId)->first();
        $query->fill($request->getParsedBody());
        $query->save();
        return redirect()->route('manage-places')->with('updated-place', 'Place updated.');
    }

    #Delete
    function deleteRiskyPlace($riskyPlaceId) {
        $query = RiskyPlace::where('id', $riskyPlaceId);
        $query->delete();
        return redirect()->route('manage-places')->with('deleted-place', 'Place deleted.');
    }

    function manageReports() {
        if (!Auth::user()) {
            return redirect()->route('home-page');
        } else if (Auth::user()->role != 'Admin') {
            return redirect()->route('home-page');
        }
        $query = Report::orderBy('date', 'desc');
        return view('a_manage_reports', [
            'reports' => $query->paginate(10)
        ]);
    }

    function managePlaces() {
        $query = RiskyPlace::orderBy('name');
        return view('a_manage_places', [
            'places' => $query->paginate(10)
        ]);
    }

    function placeUpdateForm($placeId) {
        $query = RiskyPlace::where('id', $placeId);
        return view('place-update-form', [
            'places' => $query->get()
        ]);
    }

    function addReport(ServerRequestInterface $request) {
        $query = Report::create($request->getParsedBody());
        return redirect()->route('manage-reports')->with('status', 'Report added.');
    }

    function reportUpdateForm($reportDate) {
        $query = Report::where('date', $reportDate);
        return view('report-update-form', [
            'reports' => $query->get()
        ]);
    }

    function updateReport(ServerRequestInterface $request, $reportDate) {
        $query = Report::where('date', $reportDate)->first();
        $data = $request->getParsedBody();
        DB::update('update reports set n_pmc = ?, n_prison = ?, n_ft = ?, n_recovered = ?, n_death = ? where date = ?',
            [$data['n_pmc'], $data['n_prison'], $data['n_ft'], $data['n_recovered'], $data['n_death'], $reportDate]);
        return redirect()->route('manage-reports')->with('updated-report', 'Report updated.');
    }

    function deleteReport($reportDate) {
        $query = Report::where('date', $reportDate);
        $query->delete();
        return redirect()->route('manage-reports')->with('deleted-report', 'Report deleted.');
    }
}
