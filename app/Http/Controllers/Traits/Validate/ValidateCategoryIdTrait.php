<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

use App\Models\Category;

trait ValidateCategoryIdTrait{

    public function ValidateCategoryId( $categoryId ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $validate = Validator::make( [ 
            'categoryId' => $categoryId,
        ], [
            'categoryId' => Category::RULE[ 'id' ],
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
