<?php

namespace App\Http\Controllers\Admin;
use App\Models\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRedirectRequest;
use App\Http\Requests\UpdateRedirectRequest;
use League\Csv\Reader;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{

    public function importCsv(Request $request)
    {

        if (!Auth::user()->can('redirector.store')) {
        abort(403, 'Unauthorized Access');
    }
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // Read the uploaded CSV
        $path = $request->file('csv_file')->getRealPath();
        $csv  = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // first row as header

        $records = $csv->getRecords(['url', 'redirect_to']);
        foreach ($records as $record) {
             $url        = trim($record['url']);
            $target     = trim($record['redirect_to']);
            $url = rtrim($url, '/');
            if (filter_var($url, FILTER_VALIDATE_URL) && filter_var($target, FILTER_VALIDATE_URL)) {
                Redirect::updateOrCreate(
                    ['url' => $url],
                    ['redirect_to' => $target]
                );
            }
        }

        return back()->with('success', 'CSV imported successfully!');
    }

    public function index(Request $request)
    {

          if (!Auth::user()->can('redirector.view')) {
        abort(403, 'Unauthorized Access');
    }
        $redirects = Redirect::orderBy('created_at', 'desc')->get();

        if($request->ajax()){
            return response()->json([
                'data' => $redirects
            ]);
        }
        return view('admin.pages.redirector.index');
    }

    public function store(StoreRedirectRequest $request)
    {

          if (!Auth::user()->can('redirector.store')) {
        abort(403, 'Unauthorized Access');
    }
        $redirect = Redirect::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Redirect created successfully',
            'data' => $redirect
        ]);
    }

    public function update(UpdateRedirectRequest $request, Redirect $redirector)
    {
        if (!Auth::user()->can('redirector.edit')) {
                abort(403, 'Unauthorized Access');
            }
        $redirector->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Redirect updated successfully',
            'data' => $redirector
        ]);
    }

    public function destroy(Redirect $redirector)
    {

          if (!Auth::user()->can('redirector.delete')) {
        abort(403, 'Unauthorized Access');
    }
        $redirector->delete();

        return response()->json([
            'success' => true,
            'message' => 'Redirect deleted successfully'
        ]);
    }
}
