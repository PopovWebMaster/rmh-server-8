<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Models\Category;
use App\Models\Company;

trait GetCategoryListTrait{

    public function GetCategoryList( $companyAlias ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $category = Category::where( 'company_id', '=', $company_id )->get();

        $list = [];
        foreach( $category as $model ){
            array_push( $list, [
                'id' =>         $model->id,
                'name' =>       $model->name,
                'prefix' =>     $model->prefix === null? '': $model->prefix,
                'colorText' =>  $model->colorText,
                'colorBG' =>    $model->colorBG,
            ] );
        };

        return $list;
        
    }

}


?>

