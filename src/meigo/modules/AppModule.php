<?php
namespace meigo\modules;

use std, gui, framework, meigo;


class AppModule extends AbstractModule
{


    /**
     * @event action 
     */
    function doAction(ScriptEvent $e = null)
    {    
        global $ver;
        $ver = "v0.9.1_beta";
        
        // Создание формы
        $Form = new UXForm();
        $Form->width = 704;
        $Form->height = 408;
        $Form->centerOnScreen();
        $Form->title = "BundleBuild ".$ver." | By Meigo™ Corporation";
        $Form->icons->insert(0, new UXImage('res://.data/img/dn17/bundleMake32.png')); 
        $Form->show();
        
        // Создание меню
        app()->module("design")->AddMenuBar($Form);
        
        // Создание двух текстов
        $text1 = new UXLabel;
        $text1->size = [416, 36];
        $text1->position = [8, 48];
        $text1->text = "Добро пожаловать в BundleBuild";
        $text1->font = $text1->font->withBold()->withSize(25);
        $Form->add($text1);
        
        $text2 = new UXLabel;
        $text2->size = [416, 200];
        $text2->position = [16, 88];
        $text2->text = "версия сборки: v0.9.1_beta
Разработка только начата, так что функционала здесь может не быть.";
        $text2->alignment = "TOP_LEFT";
        $text2->wrapText = true;
        $text2->font = $text2->font->withSize(15)->withRegular()->withName('Calibri');
        $Form->add($text2);
    }


}
