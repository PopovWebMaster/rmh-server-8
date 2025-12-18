<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;


use App\Models\Application;
use App\Models\Company;
use App\Models\Category;
use App\Models\Events;

use App\Models\SubApplication;
use App\Models\User;

use App\Http\Controllers\Page\AirApplications\Traits\GetSubApplicationListTrait;


trait GetApplicationListByParamsTrait{

    use GetSubApplicationListTrait;

    public function GetApplicationListByParams( $params ){

        $companyAlias =         $params[ 'companyAlias' ];
        // $manager_id =       $params[ 'manager_id' ];
        $period =               $params[ 'period' ];        // 'all' or [ 'from' => `YY_MM_DD', 'to' => `YY_MM_DD' ]
        $applicationId =        $params[ 'applicationId' ]; // 'all' or application_id
        $eventId =              $params[ 'eventId' ];       // 'all' or event_id
        $withReleaseList =      isset( $params[ 'withReleaseList' ] )?      $params[ 'withReleaseList' ]: false;    // true / false
        $withSubApplication =   isset( $params[ 'withSubApplication' ] )?   $params[ 'withSubApplication' ]: false; // true / false

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;
        $list = [];

        if( $period === 'all' ){
            if( $applicationId === 'all' ){
                if( $eventId === 'all' ){
                    $list = $this->GetAppListAllAllAll( $companyAlias, $withSubApplication, $withReleaseList );
                }else{
                    // if( $eventId === 'all' ){
                    //     // $appObject = $this->GetAppListAllAppIdAll([
                    //     //     'companyAlias' =>       $companyAlias,
                    //     //     'applicationId' =>      $applicationId,
                    //     //     'withSubApplication' => $withSubApplication,
                    //     //     'withReleaseList' =>    $withReleaseList,
                    //     // ]);
                    //     // array_push( $list, $appObject );
                    // }else{
                        $list = $this->GetAppListPeriodAllEventId([
                            'companyAlias' =>           $companyAlias,
                            'eventId' =>                $eventId,
                            'period' =>                 $period,
                            'withSubApplication' =>     $withSubApplication,
                            'withReleaseList' =>        $withReleaseList,
                            
                        ]);
                    // };
                };
            }else{
                if( $eventId === 'all' ){
                    $appObject = $this->GetAppListAllAppIdAll([
                        'companyAlias' =>       $companyAlias,
                        'applicationId' =>      $applicationId,
                        'withSubApplication' => $withSubApplication,
                        'withReleaseList' =>    $withReleaseList,
                    ]);
                    array_push( $list, $appObject );
                }else{

                    $appObject = $this->GetAppListPeriodAppIdAll([
                        'companyAlias' =>       $companyAlias,
                        'applicationId' =>      $applicationId,
                        'period' =>      $period,

                        'withSubApplication' => $withSubApplication,
                        'withReleaseList' =>    $withReleaseList,
                    ]);
                    array_push( $list, $appObject );

                    // $list = $this->GetAppListAllAllAll( $companyAlias, $withSubApplication, $withReleaseList );
                    // $list = $this->GetAppListPeriodAllEventId([
                    //     'companyAlias' =>           $companyAlias,
                    //     'eventId' =>                $eventId,
                    //     'period' =>                 $period,
                    //     'withSubApplication' =>     $withSubApplication,
                    //     'withReleaseList' =>        $withReleaseList,
                        
                    // ]);
                };
            };
        }else{
            if( $applicationId === 'all' ){
                if( $eventId === 'all' ){
                        
                    }else{
                        $list = $this->GetAppListPeriodAllEventId([
                            'companyAlias' =>           $companyAlias,
                            'eventId' =>                $eventId,
                            'period' =>                 $period,
                            'withSubApplication' =>     $withSubApplication,
                            'withReleaseList' =>        $withReleaseList,
                            
                        ]);
                    };
            }else{
                $appObject = $this->GetAppListPeriodAppIdAll([
                    'companyAlias' =>       $companyAlias,
                    'applicationId' =>      $applicationId,
                    'period' =>             $period,

                    'withSubApplication' => $withSubApplication,
                    'withReleaseList' =>    $withReleaseList,
                ]);
                array_push( $list, $appObject );
                // $list = $this->GetAppListAllAllAll( $companyAlias, $withSubApplication, $withReleaseList );
            };
        };
        return $list;

    }

    private function GetAppListAllAllAll( $companyAlias, $withSubApplication, $withReleaseList  ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;
        $list = [];
        $applications = Application::where( 'company_id', '=', $company_id )
                                   ->orderBy( 'updated_at', 'desc' )
                                   ->get();

        foreach( $applications as $model ){
            $application_id =   $model->id;
            $manager_id =       $model->manager_id;
            $category_id = $model->category_id;
            if( $category_id !== null ){
                $category = Category::find( $category_id );
                if( $category === null ){
                    $category_id = null;
                    $model->category_id = null;
                    $model->save();
                };
            };

            $event_id = $model->event_id;
            if( $event_id !== null ){
                $event = Events::find( $event_id );
                if( $event === null ){
                    $event_id = null;
                    $model->event_id = null;
                    $model->save();
                };
            };

            $appObject = $this->GetOnAppObject();

            $appObject[ 'id' ] =                    $application_id;
            $appObject[ 'application_id' ] =           $application_id;
            $appObject[ 'name' ] =                  $model->name;
            $appObject[ 'num' ] =                   $model->num === null? '': $model->num;
            $appObject[ 'manager_notes' ] =         $model->manager_notes === null? '': $model->manager_notes;
            $appObject[ 'manager' ] =               $this->GetManagerInfo__( $manager_id );
            $appObject[ 'manager_id' ] =            $manager_id;
            $appObject[ 'category_id' ] =           $category_id;
            $appObject[ 'event_id' ] =              $event_id;

            if( $withSubApplication ){
                if( $withReleaseList ){
                    $appObject[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, 'all' );
                }else{
                    $appObject[ 'sub_application_list' ] = [];
                };
            }else{
                $appObject[ 'sub_application_list' ] = [];
            };
            
            array_push( $list, $appObject );
        };
        return $list;
    }

    private function GetAppListAllAppIdAll( $params ){

        $companyAlias =         $params[ 'companyAlias' ];
        $application_id =       $params[ 'applicationId' ];
        $withSubApplication =   $params[ 'withSubApplication' ];
        $withReleaseList =      $params[ 'withReleaseList' ];

        $result = [];

        $application = Application::find( $application_id );
        if( $application !== null ){
            $category_id =      $application->category_id;
            $event_id =         $application->event_id;
            $manager_id =       $application->manager_id;
            $name =             $application->name;
            $num =              $application->num === null? '': $application->num;
            $manager_notes =    $application->manager_notes === null? '': $application->manager_notes;

            $categoryModel = Category::find( $category_id );
            if( $categoryModel === null ){
                $application->category_id = null;
                $application->save();
                $category_id = null;
            };

            $result = $this->GetOnAppObject();

            $result[ 'id' ] =       $application_id;
            $result[ 'application_id' ] =       $application_id;
            $result[ 'category_id' ] =          $category_id;
            $result[ 'event_id' ] =             $event_id;
            $result[ 'manager_id' ] =           $manager_id;
            $result[ 'manager' ] =              $this->GetManagerInfo__( $manager_id );
            $result[ 'name' ] =                 $name;
            $result[ 'num' ] =                  $num;
            $result[ 'manager_notes' ] =        $manager_notes;
            // $result[ 'sub_application_list' ] = $this->GetSubApplicationList( $application_id, 'all', true );

            if( $withSubApplication ){
                if( $withReleaseList ){
                    $result[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, 'all' );
                }else{
                    $result[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, 'all', true );
                };
            }else{
                $result[ 'sub_application_list' ] = [];
            };
        };

        return $result;
        

    }


    private function GetAppListPeriodAppIdAll( $params ){

        $companyAlias =         $params[ 'companyAlias' ];
        $application_id =       $params[ 'applicationId' ];
        $period =               $params[ 'period' ];
        $withSubApplication =   $params[ 'withSubApplication' ];
        $withReleaseList =      $params[ 'withReleaseList' ];

        $result = [];

        $application = Application::find( $application_id );
        if( $application !== null ){
            $category_id =      $application->category_id;
            $event_id =         $application->event_id;
            $manager_id =       $application->manager_id;
            $name =             $application->name;
            $num =              $application->num === null? '': $application->num;
            $manager_notes =    $application->manager_notes === null? '': $application->manager_notes;

            $categoryModel = Category::find( $category_id );
            if( $categoryModel === null ){
                $application->category_id = null;
                $application->save();
                $category_id = null;
            };

            $result = $this->GetOnAppObject();

            $result[ 'id' ] =       $application_id;
            $result[ 'application_id' ] =       $application_id;
            $result[ 'category_id' ] =          $category_id;
            $result[ 'event_id' ] =             $event_id;
            $result[ 'manager_id' ] =           $manager_id;
            $result[ 'manager' ] =              $this->GetManagerInfo__( $manager_id );
            $result[ 'name' ] =                 $name;
            $result[ 'num' ] =                  $num;
            $result[ 'manager_notes' ] =        $manager_notes;
            // $result[ 'sub_application_list' ] = $this->GetSubApplicationList( $application_id, 'all', true );

            if( $withSubApplication ){
                if( $withReleaseList ){
                    $result[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, $period );
                }else{
                    $result[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, $period, true );
                };
            }else{
                $result[ 'sub_application_list' ] = [];
            };
        };

        return $result;
        

    }




    private function GetAppListPeriodAllEventId( $params ){

        $companyAlias =         $params[ 'companyAlias' ];
        $eventId =              $params[ 'eventId' ];
        $period =               $params[ 'period' ];
        $withSubApplication =   $params[ 'withSubApplication' ];
        $withReleaseList =      $params[ 'withReleaseList' ];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;
        $list = [];
        $applications = Application::where( 'company_id', '=', $company_id )
                                    ->orderBy( 'updated_at', 'desc' )
                                   ->get();

        foreach( $applications as $model ){
            $application_id =   $model->id;
            $manager_id =       $model->manager_id;
            $category_id =      $model->category_id;
            if( $category_id !== null ){
                $category = Category::find( $category_id );
                if( $category === null ){
                    $category_id = null;
                    $model->category_id = null;
                    $model->save();
                };
            };

            $event_id = $model->event_id;
            if( $event_id !== null ){
                $event = Events::find( $event_id );
                if( $event === null ){
                    $event_id = null;
                    $model->event_id = null;
                    $model->save();
                };
            };

            $appObject = $this->GetOnAppObject();

            $appObject[ 'id' ] =                    $application_id;
            $appObject[ 'application_id' ] =        $application_id;
            $appObject[ 'name' ] =                  $model->name;
            $appObject[ 'num' ] =                   $model->num === null? '': $model->num;
            $appObject[ 'manager_notes' ] =         $model->manager_notes === null? '': $model->manager_notes;
            $appObject[ 'manager' ] =               $this->GetManagerInfo__( $manager_id );
            $appObject[ 'manager_id' ] =            $manager_id;
            $appObject[ 'category_id' ] =           $category_id;
            $appObject[ 'event_id' ] =              $event_id;

            if( $event_id === $eventId ){
                if( $withSubApplication ){
                    if( $withReleaseList ){
                        $appObject[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, $period );
                    }else{
                        $appObject[ 'sub_application_list' ] =  $this->GetSubApplicationList( $application_id, $period, true );
                    };
                }else{
                    $appObject[ 'sub_application_list' ] = [];
                };
            }else{
                $appObject[ 'sub_application_list' ] = [];
            };

            
            
            array_push( $list, $appObject );
        };

        return $list;
    }


    private function GetManagerInfo__( $user_id ){

        $result = [
            'name' => '',
            'id' => null,
        ];

        $user = User::find( $user_id );

        if( $user !== null ){
            $result[ 'name' ] = $user->name;
            $result[ 'id' ] =   $user_id;
        };

        return $result;

    }
    private function GetOnAppObject(){
        return [
            'id' =>                     null,
            'application_id' =>         null,
            'name' =>                   '',
            'num' =>                    '',
            'manager_notes' =>          '',
            'manager_id' =>             null,
            'manager' =>                [],
            'category_id' =>            null,
            'event_id' =>               null,
            'sub_application_list' =>   [],

        ];

    }

}


?>


