<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\GetCategoryListTrait;
use App\Http\Controllers\Traits\Validate\ValidateOneCategoryTrait;

use App\Models\Company;
use App\Models\Category;

trait SaveCategoryListTrait{

    use GetCategoryListTrait;
    use ValidateOneCategoryTrait;

    public function SaveCategoryList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $result[ 'ok' ] = true;

        $list =  $request['data']['list'];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;
        $result[ 'message' ] = [];
        
        for( $i = 0; $i < count( $list ); $i++ ){

            $categoryId =        $list[ $i ][ 'id' ];
            $categoryName =      $list[ $i ][ 'name' ];
            $categoryPrefix =    $list[ $i ][ 'prefix' ];
            $categoryColorText = $list[ $i ][ 'colorText' ];
            $categoryColorBG =   $list[ $i ][ 'colorBG' ];

            $validate = $this->ValidateOneCategory([
                'categoryName' =>       $categoryName,
                'categoryPrefix' =>     $categoryPrefix,
                'categoryColorText' =>  $categoryColorText,
                'categoryColorBG' =>    $categoryColorBG,
            ]);

            if( $validate[ 'fails' ] ){
                array_push( $result[ 'message' ], $validate[ 'message' ]);
            }else{


                $category = Category::find( $categoryId );
                if( $category !== null  ){

                    $category->name =       $categoryName;
                    $category->prefix =     $categoryPrefix;
                    $category->colorText =  $categoryColorText;
                    $category->colorBG =    $categoryColorBG;
                    $category->save();
                };
            };

        };

        $result[ 'list' ] = $this->GetCategoryList( $companyAlias );
        $result[ 'data' ] = $request['data'];

        return $result;
        
    }

}


?>

