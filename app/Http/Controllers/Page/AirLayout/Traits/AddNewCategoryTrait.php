<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateOneCategoryTrait;
use App\Http\Controllers\Traits\GetCategoryListTrait;

use App\Models\Company;
use App\Models\Category;

trait AddNewCategoryTrait{

    USE ValidateOneCategoryTrait;
    USE GetCategoryListTrait;

    public function AddNewCategory( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $validateOneCategory = $this->ValidateOneCategory([
            'categoryName' =>       isset( $request['data']['categoryName'] )?      $request['data']['categoryName']: null,
            'categoryPrefix' =>     isset( $request['data']['categoryPrefix'] )?    $request['data']['categoryPrefix']: null,
            'categoryColorText' =>  isset( $request['data']['categoryColorText'] )? $request['data']['categoryColorText']: null,
            'categoryColorBG' =>    isset( $request['data']['categoryColorBG'] )?   $request['data']['categoryColorBG']: null,
        ]);

        if( $validateOneCategory[ 'fails' ] ){
            $result[ 'message' ] = $validateOneCategory[ 'message' ];
        }else{
            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $category = new Category;
            $category->company_id = $company_id;
            $category->name =       $request['data']['categoryName'];
            $category->prefix =     $request['data']['categoryPrefix'];
            $category->colorText =  $request['data']['categoryColorText'];
            $category->colorBG =    $request['data']['categoryColorBG'];
            $category->save();

            $result[ 'list' ] = $this->GetCategoryList( $companyAlias );

        };




        return $result;
        
    }

}


?>

