<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Interverntion;

use App\Models\Liver;

class LiverController extends Controller
{
    public function autocomplete(Request $request)
    {
        $state = $request->get('state');
        $term = $request->get('term');
        $livers = Liver::query()
            ->where('last_name', 'LIKE', "%$term%")
            ->orWhere('first_name', 'LIKE', "%$term%")
            ->orWhere('second_name', 'LIKE', "%$term%");
        switch ($state) {
            case 'active':
                $livers = $livers->active();
                break;
            case 'nonactive':
                $livers = $livers->nonactive();
                break;
        }
        $livers = $livers->take(5)->get();
        $results = array();
        foreach ($livers as $liver)
        {
            $results[] = [ 'id' => $liver->id, 'value' => $liver->full_name()];
        }
        return Response::json($results);
    }

    public function index(Request $request)
    {
        $filter = $request->all();
        $filter['state'] = array_key_exists('state', $filter) ? $filter['state'] : null;
        switch ($filter['state']) {
            case 'active':
                $livers = Liver::active();
                break;
            case 'nonactive':
                $livers = Liver::nonactive();
                break;
            default:
                $livers = Liver::query();
                break;
        }
        $q = array_key_exists('q', $filter) ? $filter['q'] : null;
        if ($q) {
            $livers = $livers->where('id', '=', $q);
        }
            $livers = $livers
                ->paginate(config('app.paginated_by'))
                ->withPath($request->url());
        return view('liver.index', ['livers' => $livers, 'filter' => $filter]);
    }

    public function create()
    {
        return view('liver.create', ['university' => University::first()]);
    }
    public function store(Request $request)
    {
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id', 'is_student']);
        if ($request->input('is_student') == '1')
            $input['group_id'] = $request->input('group_id');
        $liver = Liver::create($input);
        return redirect()->route('livers.show', ['liver' => $liver]);
    }

    public function show(Request $request, Liver $liver)
    {
        $page = $request->get('page') ?: 'profile';
        return view('liver.show', ['liver' => $liver, 'page' => $page]);
    }
    public function edit(Liver $liver)
    {
        return view('liver.edit', ['liver' => $liver, 'university' => University::first()]);
    }
    public function update(Request $request, Liver $liver)
    {
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id', 'is_student']);
        if ($request->input('is_student') == '1')
            $input['group_id'] = $request->input('group_id');
        $liver->fill($input);
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
    public function destroy(Liver $liver)
    {
        $liver->delete();
        return redirect()->route('livers.index');
    }
}
