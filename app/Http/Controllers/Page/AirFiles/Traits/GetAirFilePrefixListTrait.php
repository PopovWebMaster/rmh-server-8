<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use Validator;

use App\Models\Company;
use App\Models\AirFilePrefix;


trait GetAirFilePrefixListTrait{

    public function GetAirFilePrefixList( $companyAlias ){

        $result = [];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $airFilePrefix = AirFilePrefix::where( 'company_id', '=', $company_id )->get();

        foreach( $airFilePrefix as $item ){
            array_push( $result, [
                'id' =>         $item->id,
                'prefix' =>     $item->prefix,
                'eventId' =>    $item->event_id,
            ] );
        };

        return $result;
        
    }

}


?>

