<?php 

namespace App\Http\Controllers\Traits;

use App\Models\KeyPoints;
use App\Models\Company;

trait GetKeyPointListTrait{

    public function GetKeyPointList( $companyAlias ){

        $result = [];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $keyPoints = KeyPoints::where('company_id', '=', $company_id )->get();

        foreach( $keyPoints as $item ){
            array_push( $result, [
                'dayNum' =>       $item->dayNum,
                'description' =>  $item->description,
                'ms' =>           $item->ms,
                'time' =>         $item->time,
            ] );
        };

        return $result;
        
    }

}


?>

