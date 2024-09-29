<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $fields = [
            'header_logo' ,
            'footer_logo' ,

            'title' ,
            'site_name' ,
            'tag' ,
            'keywords' ,
            'image' ,
            'map_link' ,
            'address',

            // 'sitemap' ,
            // 'terms_and_condition' ,

            'youtube',
            'whatsapp' ,
            'telegram' ,
            'facebook' ,
            'phone_numbers',
            'emails',

            'short_intro' ,
            'shiping_on_order' ,
            'shiping_and_delivery' ,

            // 'schema_tag' ,

            'return_and_exchange' ,
            'payment_gateway_logo' ,

            'outside_dhaka' ,
            'inside_dhaka',

            'home_page_description' ,
            'description' ,

            'fabicon' ,
            'copy_right' ,
            'breaking_news' ,

            // 'cookies_policy' ,
            // 'about_us' ,
        ];

        $SettingModel = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;
        $settings = $SettingModel::query()
            ->select('id','title')
            ->whereIn('title', $fields)
            ->with('setting_values:id,setting_title_id,value')
            ->get();

        $all_category_parents = \App\Modules\WebsiteApi\Category\Actions\GetAllCategoryParent::execute();
        $user = null;
        $select = ['role_id','slug', 'name', 'user_name', 'email', 'phone_number', 'photo'];
        if(auth()->check()){
            $user = \App\Modules\UserManagement\User\Models\Model::select($select)
                ->with('role')
                ->first();
        }
        return array_merge(parent::share($request), [
            // 'auth' => function () use ($request, $user) {
            //     return $user;
            // },
            'auth' => $user,
            'settings' => $settings,
            'all_category_parents' => $all_category_parents,
        ]);
    }
}
