<?php 

namespace App\Http\Controllers\Traits\Validate;

use App\Http\Controllers\Traits\Validate\ValidateOneGridEventTrait;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateGridEventsDayListTrait{

    use ValidateOneGridEventTrait;

    public function ValidateGridEventsDayList( $params ){

        $result = [
            'fails' => false,
            'message' => [],
        ];

        $dayList = $params[ 'dayList' ];
        $withNewCut = $params[ 'withNewCut' ]; // treu false есть ли в списке новые части порезки событий, если true значит в списке есть события с id = null

        $id_isRequired = !$withNewCut;

        if( is_array( $dayList ) ){

            for( $i = 0; $i < count( $dayList ); $i++ ){
                $validate = $this->ValidateOneGridEvent( $dayList[ $i ], $id_isRequired );
                if( $validate[ 'fails' ] ){
                    $result[ 'fails' ] = true;
                    for( $error_i = 0; $error_i < count( $validate[ 'message' ] ); $error_i++ ){
                        $str = $validate[ 'message' ][ $error_i ].', INDEX - '.$i;
                        array_push( $result[ 'message' ], $str );
                    };
                };
            };

 
        }else{
            $result[ 'message' ] = 'Список не является массивом';
        };

        return $result;
        
    }

}


?>
