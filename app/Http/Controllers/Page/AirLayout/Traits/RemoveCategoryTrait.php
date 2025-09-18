<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateCategoryIdTrait;
use App\Http\Controllers\Traits\GetCategoryListTrait;

use App\Models\Category;

use App\Models\Application;

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


            $applications = Application::where( 'category_id', '=', $categoryId )->get();
            foreach( $applications as $model ){
                $model->category_id = null;
                $model->event_id = null;
                $model->save();
            };

            $result[ 'list' ] = $this->GetCategoryList( $companyAlias );

        };

        return $result;
        
    }

}


?>

