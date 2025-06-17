<?php 

namespace App\Http\Controllers\Page\Admin\Traits;


trait GetStartingDataAdminTrait{

    public function GetStartingDataAdmin( $request, $user ){

        $result = [
            'ok' => true,
            'message' => 'проверка пройдена admin',
        ];


        return $result;
        
    }

}


?>

