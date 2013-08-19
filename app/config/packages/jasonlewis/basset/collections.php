<?php

return array(

        'application' => function($collection)
        {
            // Switch to the stylesheets directory and require the "less" and "sass" directories.
            // These directories both have a filter applied to them so that the built
            // collection will contain valid CSS.
            $directory = $collection->directory('../app/assets/stylesheets', function($collection)
            {
                $collection->requireDirectory('less')->apply('Less');
                $collection->requireDirectory('sass')->apply('Sass');
                $collection->requireDirectory();
            });

            $directory->apply('CssMin');
            $directory->apply('UriRewriteFilter');

            // Switch to the javascripts directory and require the "coffeescript" directory. As
            // with the above directories we'll apply the CoffeeScript filter to the directory
            // so the built collection contains valid JS.
            $directory = $collection->directory('../app/assets/javascripts', function($collection)
            {
                $collection->requireDirectory('coffeescripts')->apply('CoffeeScript');
                $collection->requireDirectory();
            });

            $directory->apply('JsMin');
        }, 
        
        'bootstrap' => function($collection){
            
            $collection->stylesheet('http://bootstrap/css/bootstrap.min.css')->raw();
            $collection->javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js')-;
            $collection->javascript('bootstrap/js/bootstrap.min.js')->raw();
           
        },

        'otherlibs' => function($collection){
           
            $collection->requireDirectory('css');
            $collection->requireDirectory('js');
        }

    );
