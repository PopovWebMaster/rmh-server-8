<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

use App\Models\Category;

trait ValidateOneCategoryTrait{

    public function ValidateOneCategory( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $categoryName =      $params[ 'categoryName' ];
        $categoryPrefix =    $params[ 'categoryPrefix' ];
        $categoryColorText = $params[ 'categoryColorText' ];
        $categoryColorBG =   $params[ 'categoryColorBG' ];

        $validate = Validator::make( [ 
            'categoryName' =>       $categoryName,
            'categoryPrefix' =>     $categoryPrefix,
            'categoryColorText' =>  $categoryColorText,
            'categoryColorBG' =>    $categoryColorBG,

        ], [
            'categoryName' =>       Category::RULE[ 'name' ],
            'categoryPrefix' =>     Category::RULE[ 'prefix' ],
            'categoryColorText' =>  Category::RULE[ 'colorText' ],
            'categoryColorBG' =>    Category::RULE[ 'colorBG' ],

        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $result[ 'fails' ] = false;
        };

        return $result;
        
    }

}


?>
