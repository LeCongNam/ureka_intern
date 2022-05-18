<?php

namespace Modules;

use File;


class ServiceProvider extends  \Illuminate\Support\ServiceProvider
{
    public function boot(){
        $listModule = array_map('basename', File::directories(__DIR__));
        foreach ($listModule as $module) {
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }else{
                return exit('File Router not Found in Module!!');
            }
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }else{
                return  exit('File View not Found!!');
            }

        }
    }

    public function register(){}
}
