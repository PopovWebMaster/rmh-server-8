<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateCategoryIdTrait;
use App\Http\Controllers\Traits\GetCategoryListTrait;

use App\Models\Category;

trait RemoveCategoryTrait{

    use ValidateCategoryIdTrait;
    use GetCategoryListTrait;

    public function RemoveCategory( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $categoryId = isset( $request['data']['categoryId'] )? $request['data']['categoryId']: null;

        $validateCategoryId = $this->ValidateCategoryId( $categoryId );

        if( $validateCategoryId[ 'fails' ] ){
            $result[ 'message' ] = $validateCategoryId[ 'message' ];
        }else{
            $result[ 'ok' ] = true;

            $category = Category::find( $categoryId );
            $category->delete();

            $result[ 'list' ] = $this->GetCategoryList( $companyAlias );

        };

        return $result;
        
    }

}


?>

