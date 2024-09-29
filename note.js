/*
    make,table,migration,seed,include,all

    stap-1
        php artisan make:module LocationManagement/Country [name:string,country_code:string,country_short_code:string,flag_url:string]
    stap-2
        tabile-e data size add korte hobe 20,100 etc
    stap-3
        migration --> php artisan migrate --path='\App\Modules\LocationManagement\Country\Database\create_countries_table.php'
        php artisan migrate --path='app/Modules/LocationManagement/Country/Database/create_countries_table.php'
    stap-4
        seeder --> php artisan db:seed --class="\App\Modules\LocationManagement\Country\Database\Seeder"
    stap-5
        api_routes -e include route kora
    stap-6
        all controller -e search key
    stap-8
        postman -e test kora

    test:
        All: sort_by_col,sort_type,status,fields shob add korte hobe
        show: slug pass korte hobe ar "fields" add korte hobe.
        update: slug pass korte hobe ar ja ja update hobe ta ta add korte hobe.
        soft-delete: slug param hisebe add korte hobe.
        restore: slug param hisebe add korte hobe.
        destroy: slug pass korte hobe.
        import: {
            "data":[
                {

                },
                {

                },
            ]
        }
        bulk-action: "action":"inactive","ids": [1,2,3,4,5] bodyte add korte hobe.



*/

/*
    thik korte hobe:
    1)update er id er jaygay slug hobe route-e
*/



/*
    location management
        Country [name:string,country_code:string,country_short_code:string,flag_url:string]
        StateDivision [country_id:bigint,name:string]
        District [country_id:bigint,state_division_id:bigint,name:string]
        Thana [country_id:bigint,state_division_id:bigint,station_id:bigint,name:string]
        City [country_id:bigint,state_division_id:bigint,station_id:bigint,city_id:bigint,name:string]


 */
// test change
// test change again
// ehsan change agai
/*



*/

// price issue document
