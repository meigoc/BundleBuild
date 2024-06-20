<?php
namespace meigo\forms;

use std, gui, framework, meigo;


class MainForm extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $mainMenu = new UXMenuBar(); 

        //$mainMenu ->width = 450;
        $mainMenu->anchors = ['left' => 0, 'right' => 0];
   
        $this->add($mainMenu);
        
        
        $Menu = new UXMenu('Проект');
        $Menu2 = new UXMenu('Сборка');
        //$Menu->items->add(UXMenuItem::createSeparator());
            
        $mainMenu->menus->add($Menu);
        $mainMenu->menus->add($Menu2);
        
        $newi = new UXImageView();
        $newi->image = new UXImage('res://.data/img/dn17/new16.png');           
        $new = new UXMenuItem('Новый проект', $newi);
        $new->on('action', function ($e) use ($new){
           UXDialog::show('Выбран пункт '.$new->text);
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

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $tree = new UXTreeView;
        $tree->position = [0, 64];
        $tree->size = [160, 344];
        $tree->anchors = ['top' => 64, 'bottom' => 0];
        $this->add($tree);
        
        $panel = new UXPanel;
        $panel->backgroundColor = "#f2f2f2";
        $panel->position = [0, 24];
        $panel->size = [704, 40];
        $panel->anchors = ['left' => 0, 'right' => 0];
        
        $meigoid_button = new UXButton;
        $meigoid_button->size = [144, 34];
        $meigoid_button->position = [3, 3];
        $meigoid_button->text = "тут скоро что-то будет";
        
        $separator1 = new UXSeparator;
        $separator1->orientation = "VERTICAL";
        $separator1->size = [16, 34];
        $separator1->position = [144, 3];
        
        $newproject_button = new UXButton;
        //$newproject_button->position = [3, 27];
        $newproject_button->size = [35, 34];
        $newproject_button->position = [153, 3]; // + 147
        $newproject_button->graphic = new UXImageView(new UXImage('res://.data/img/dn17/new16.png'));
        $newproject_button->text = null;
        
        $openproject_button = new UXButton;
        $openproject_button->size = [35, 34];
        $openproject_button->position = [191, 3]; // +38
        $openproject_button->graphic = new UXImageView(new UXImage('res://.data/img/dn17/open16.png'));
        $openproject_button->text = null;
        
        $saveproject_button = new UXButton;
        $saveproject_button->size = [35, 34];
        $saveproject_button->position = [229, 3]; // +38
        $saveproject_button->graphic = new UXImageView(new UXImage('res://.data/img/dn17/save16.png'));
        $saveproject_button->text = null;
        
        $savezipproject_button = new UXButton;
        $savezipproject_button->size = [35, 34];
        $savezipproject_button->position = [267, 3]; // +38
        $savezipproject_button->graphic = new UXImageView(new UXImage('res://.data/img/dn17/saveAs16.png'));
        $savezipproject_button->text = null;
        
        $s_button = new UXButton;
        $s_button->size = [340, 34];
        $s_button->position = [305, 3]; // +38
        $s_button->graphic = new UXImageView(new UXImage('res://.data/img/dn17/warning16.png'));
        $s_button->text = "это бета-версия, какие-то функции могут не работать.";
        
        $panel->add($meigoid_button);
        $panel->add($separator1);
        $panel->add($newproject_button);
        $panel->add($openproject_button);
        $panel->add($saveproject_button);
        $panel->add($savezipproject_button);
        $panel->add($s_button);
        $this->add($panel);
        //$this->panel->add($separator2);
    }






}
