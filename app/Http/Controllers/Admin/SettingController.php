<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function edit()
    {
   
      $settings = setting()->all();


        return view('admin.pages.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        if (!Auth::user()->can('settings.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $data = $request->validate([
            'site_name'         => 'required|string|max:255',
            'stripe_key'        => 'required|string',
            'paypal_key'        => 'required|string',
            'paypal_client_id'  => 'required|string',
            'mail_mailer'       => 'required|string',
            'mail_host'         => 'required|string',
            'mail_port'         => 'required|integer',
            'mail_username'     => 'required|string',
            'mail_password'     => 'required|string',
            'mail_encryption'   => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name'    => 'required|string',
            'talkto_link'       => 'required|url',
            'talkto_enabled'    => 'required|boolean',
            'paypal_mode' => 'required|string',
            'webhook_secret' => 'required|string',
            'cc_address'    => 'required|string',
            'admin_email'    => 'required|string',
        ]);

        $tawkto=$data['talkto_enabled'];
        $data['talkto_enabled']=$tawkto == 1 ? true : null;

        setting($data);
        setting()->save();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}
