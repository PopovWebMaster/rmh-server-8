<?php 

namespace App\Http\Controllers\Page\Home\Traits;


trait GetStartingDataHomeTrait{

    public function GetStartingDataHome( $request, $user ){

        $result = [
            'ok' => true,
            'message' => 'проверка пройдена',
        ];


        return $result;
        
    }

}


?>

