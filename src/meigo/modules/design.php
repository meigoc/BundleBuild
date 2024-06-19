<?php
namespace meigo\modules;

use std, gui, framework, meigo;


class design extends AbstractModule
{
    function AddMenuBar($form)
    {
        $mainMenu = new UXMenuBar(); 

        //$mainMenu ->width = 450;
        $mainMenu->anchors = ['left' => 0, 'right' => 0];
   
        $form->add($mainMenu);
        
        
        $Menu = new UXMenu('Проект');
        $Menu2 = new UXMenu('Сборка');
        //$Menu->items->add(UXMenuItem::createSeparator());
            
        $mainMenu->menus->add($Menu);
        $mainMenu->menus->add($Menu2);
        
        $newi = new UXImageView();
        $newi->image = new UXImage('res://.data/img/dn17/new16.png');           
        $new = new UXMenuItem('Новый проект', $newi);
        $new->on('action', function ($e) use ($new){
           
           // Создание проекта
           
           app()->showForm("new");
           waitAsync(500, function () use ($e, $event) {
               foreach(app()->form("new")->children as $obj) { 
                    $obj->enabled = true;
               }
           });
        });                         
        $Menu->items->add($new); 



        $open = new UXImageView();
      
        $open->image = new UXImage('res://.data/img/open16.png');    
         
            
        $menuItem1 = new UXMenuItem('Открыть проект', $open);
        
        $menuItem1->on('action', function ($e) use ($menuItem1){
       
           UXDialog::show('Выбран пункт '.$menuItem1->text);
          
        });                 
      
        $Menu->items->add($menuItem1); 
              

        $save = new UXImageView();
      
        $save->image = new UXImage('res://.data/img/save16.png');   
            
                  
        $menuItem2 = new UXMenuItem('Сохранить', $save); 
        
        $menuItem2->on('action', function ($e) use ($menuItem2){
       
           UXDialog::show('Выбран пункт '.$menuItem2->text);
          
        });                         
      
        $Menu->items->add($menuItem2); 
        
          $Menu->items->add(UXMenuItem::createSeparator());
          
          
          
          $savearchive = new UXImageView();
        $savearchive->image = new UXImage('res://.data/img/dn17/saveAs16.png');           
        $savezip = new UXMenuItem('Сохранить как архив', $savearchive); 
        $savezip->on('action', function ($e) use ($savezip){
           UXDialog::show('Выбран пункт '.$savezip->text);
        });                         
        $Menu->items->add($savezip); 
        
        
        $savelibrary = new UXImageView();
        $savelibrary->image = new UXImage('res://.data/img/dn17/library16.png');           
        $savelib = new UXMenuItem('Сохранить проект в библиотеке [В разработке]', $savelibrary); 
        $savelib->disable = true;
        $savelib->on('action', function ($e) use ($savelib){
           UXDialog::show('Выбран пункт '.$savelib->text);
        });                         
        $Menu->items->add($savelib); 
          
          
          
          $Menu->items->add(UXMenuItem::createSeparator());
 
        $ext = new UXImageView();
      
        $ext->image = new UXImage('res://.data/img/exit16.png');    
           
                
        $menuItem3 = new UXMenuItem('Выход', $ext); 
        
        $menuItem3->on('action', function ($e) use ($menuItem3){
       
           app()->shutdown();
          
        });                         
      
        $Menu->items->add($menuItem3);
    }
}