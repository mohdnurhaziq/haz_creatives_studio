<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class SettingController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->is_admin) {
                abort(403, 'Unauthorized access. Admin privileges required.');
            }
            return $next($request);
        });
    }

    /**
     * Display the settings page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::getAllSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|string|max:255',
            'timezone' => 'required|string|max:255',
            'currency' => 'required|string|max:3',
            'email_notification' => 'boolean',
            'sms_notification' => 'boolean',
            'maintenance_mode' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Setting::updateOrCreate(
            ['key' => 'site_name'],
            ['value' => $request->site_name]
        );

        Setting::updateOrCreate(
            ['key' => 'timezone'],
            ['value' => $request->timezone]
        );

        Setting::updateOrCreate(
            ['key' => 'currency'],
            ['value' => $request->currency]
        );

        Setting::updateOrCreate(
            ['key' => 'email_notification'],
            ['value' => $request->boolean('email_notification')]
        );

        Setting::updateOrCreate(
            ['key' => 'sms_notification'],
            ['value' => $request->boolean('sms_notification')]
        );

        Setting::updateOrCreate(
            ['key' => 'maintenance_mode'],
            ['value' => $request->boolean('maintenance_mode')]
        );

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Update general settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:50',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'tax_id' => 'nullable|string|max:50',
        ]);

        $this->updateSettings($request->all());

        return redirect()->back()->with('success', 'Company information updated successfully.');
    }

    /**
     * Update email settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmail(Request $request)
    {
        $request->validate([
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|numeric',
            'smtp_username' => 'required|string',
            'smtp_password' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
        ]);

        $this->updateSettings($request->all());

        // Update mail configuration
        Config::set('mail.mailers.smtp.host', $request->smtp_host);
        Config::set('mail.mailers.smtp.port', $request->smtp_port);
        Config::set('mail.mailers.smtp.username', $request->smtp_username);
        Config::set('mail.mailers.smtp.password', $request->smtp_password);
        Config::set('mail.from.address', $request->from_email);
        Config::set('mail.from.name', $request->from_name);

        return redirect()->back()->with('success', 'Email settings updated successfully.');
    }

    /**
     * Update invoice settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInvoice(Request $request)
    {
        $request->validate([
            'invoice_prefix' => 'required|string|max:10',
            'next_invoice_number' => 'required|numeric|min:1',
            'invoice_footer' => 'nullable|string',
            'payment_terms' => 'nullable|string',
        ]);

        $this->updateSettings($request->all());

        return redirect()->back()->with('success', 'Invoice settings updated successfully.');
    }

    /**
     * Update notification settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNotification(Request $request)
    {
        $settings = [
            'email_notifications' => $request->has('email_notifications'),
            'invoice_notifications' => $request->has('invoice_notifications'),
            'payment_notifications' => $request->has('payment_notifications'),
        ];

        $this->updateSettings($settings);

        return redirect()->back()->with('success', 'Notification settings updated successfully.');
    }

    /**
     * Update backup settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBackup(Request $request)
    {
        $request->validate([
            'auto_backup' => 'required|in:daily,weekly,monthly',
            'backup_storage' => 'required|in:local,cloud',
        ]);

        $settings = array_merge($request->all(), [
            'enable_2fa' => $request->has('enable_2fa'),
        ]);

        $this->updateSettings($settings);

        return redirect()->back()->with('success', 'Backup & security settings updated successfully.');
    }

    /**
     * Helper method to update settings in the database.
     *
     * @param  array  $settings
     * @return void
     */
    private function updateSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now()]
            );
        }
    }
} 