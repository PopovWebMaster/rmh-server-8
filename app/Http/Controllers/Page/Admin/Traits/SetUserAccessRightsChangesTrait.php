<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Traits\GetUserAccessRightsTrait;

use App\Models\User;
use App\Models\UserCompany;
use App\Models\Company;
use App\Models\UserAccessRight;



trait SetUserAccessRightsChangesTrait{

    use GetUserAccessRightsTrait;

    public function SetUserAccessRightsChanges( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $userId =           isset( $request[ 'data' ][ 'userId' ] )?        $request[ 'data' ][ 'userId' ]: null;
        $userAccess =       isset( $request[ 'data' ][ 'userAccess' ] )?    $request[ 'data' ][ 'userAccess' ]: null;
        $userCompanies =    isset( $request[ 'data' ][ 'userCompanies' ] )? $request[ 'data' ][ 'userCompanies' ]: null;

        if( $userId === null ){
            $result[ 'message' ] = 'Что-то не так с айдишником пользователя';
        }else{
            $searshUser = User::find( $userId );
            if( $searshUser === null ){
                $result[ 'message' ] = 'Айдишник не верный';
            }else{

                if( $userCompanies === null ){
                    $result[ 'message' ] = 'Проблемы со списком компаний';
                }else{
                    if( $userAccess === null ){
                        $result[ 'message' ] = 'Проблемы с userAccess';
                    }else{

                        $result[ 'ok' ] = true;

                        $this->SetUserCompanyChanges([
                            'userId' =>         $userId,
                            'userCompanies' =>  $userCompanies,
                        ]);

                        $this->SetUserAccessChanges([
                            'userId' =>         $userId,
                            'userAccess' =>  $userAccess,
                        ]);

                        
                        $companyAliasList = [];
                        $userCompany = UserCompany::where( 'user_id', '=', $userId )->get();
                        foreach( $userCompany as $item ){
                            $company_id = $item->company_id;
                            $company = Company::find( $company_id );
                            array_push( $companyAliasList, $company->alias );
                        };

                        $result[ 'userAccsessRights' ] = $this->GetUserAccessRights( $userId );
                        $result[ 'companyAliasList' ] = $companyAliasList;

                    };
                };

            };
        };
       
        return $result;
        
    }

    private function SetUserCompanyChanges( $params ){

        $userId =           $params[ 'userId' ];
        $userCompanies =    $params[ 'userCompanies' ];

        $userCompany = UserCompany::where( 'user_id', '=', $userId )->get();

        $companies = [];
        foreach( $userCompany as $item ){
            $company_id = $item->company_id;
            $company = Company::find( $company_id );
            $alias = $company->alias;
            $companies[ $alias ] = false;
        };

        for( $i = 0; $i < count( $userCompanies ); $i++ ){
            $companies[ $userCompanies[ $i ] ] = true;
        };

        foreach( $companies as $alias => $value ){

            $company = Company::where( 'alias', '=', $alias )->first();
            $company_id = $company->id;

            $userCompanyModel = UserCompany::where( 'user_id', '=', $userId )->where( 'company_id', '=', $company_id )->first();

            if( $companies[ $alias ] === true ){
                if( $userCompanyModel === null ){
                    $newModel = new UserCompany;
                    $newModel->user_id = $userId;
                    $newModel->company_id = $company_id;
                    $newModel->save();
                };
            }else if( $companies[ $alias ] === false ){
                if( $userCompanyModel !== null ){
                    $userCompanyModel->delete();
                };
            };
        };



    }

    private function SetUserAccessChanges( $params ){

        $userId =       $params[ 'userId' ];
        $userAccess =   $params[ 'userAccess' ];

        $userAccessRight = UserAccessRight::where( 'user_id', '=', $userId )->get();

        $accessList = [];
        foreach( $userAccessRight as $item ){
            $accessList[ $item->access ] = false;
        };

        for( $i = 0; $i < count( $userAccess ); $i++ ){
            $accessList[ $userAccess[ $i ] ] = true;
        };

        foreach( $accessList as $access => $value ){

            $userAccessRight = UserAccessRight::where( 'user_id', '=', $userId )->where( 'access', '=', $access )->first();

            if( $accessList[ $access ] === true ){
                if( $userAccessRight === null ){
                    $newModel = new UserAccessRight;
                    $newModel->user_id = $userId;
                    $newModel->access = $access;
                    $newModel->save();
                };
            }else if( $accessList[ $access ] === false ){
                if( $userAccessRight !== null ){
                    $userAccessRight->delete();
                };
            };
        };

    }

}


?>


