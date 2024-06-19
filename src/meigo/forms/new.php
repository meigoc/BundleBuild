<?php
namespace meigo\forms;

use std, gui, framework, meigo;


class new extends AbstractForm
{

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)
    {    
        foreach($this->children as $obj) { 
             $obj->enabled = false;
             //
        }
        
        $array = ['e1' => $this->e1->text, 'e2' => $this->e2->text, 'e3' => $this->e3->text, 'e4' => $this->e4->text, 'e5' => $this->e5->text, 'e6' => $this->e6->text, 'e7' => $this->e7->text];

        foreach ($array as $key => $value) {
            //echo "[INFO] $key = $value \n";
            
            switch($key){
                case 'e1':
                    $name = "Имя пакета";
                break;

                case 'e2':
                    $name = "Автор пакета";
                break;
                
                case 'e3':
                    $name = "Версия пакета";
                break;

                case 'e4':
                    $name = "Иконка пакета";
                break;
                
                case 'e5':
                    $name = "Описание пакета (первая строчка)";
                break;

                case 'e6':
                    $name = "Описание пакета (вторая строчка)";
                break;
                
                case 'e7':
                    $name = "Описание ввиде .html";
                break;
            }
            
            echo "[INFO] ".$name."\n";
            
            if ($value == null){
                alert('Вы не заполнили поле "'.$name.'"');
                foreach($this->children as $obj) { 
                     $obj->enabled = true;
                     //
                }
                return false;
            }
        }
        
        
            
            global $USERPROFILE;
            $nfolder_projects = $USERPROFILE."\\BundleBuildProjects"; // папка проектов    
            $folder_projects = str::replace($nfolder_projects, "\\", "/");
            // Создание папки проекта
            if (fs::isDir($folder_projects."/".$this->e1->text)) {
                alert("Проект с таким именем уже существует!");
                foreach($this->children as $obj) { 
                     $obj->enabled = true;
                     //
                }
            } else {
                echo "[INFO] Creating project...\n";
                $dir = new File($folder_projects."/".$this->e1->text."/bundle");
    
                    // folder project/bundle
                if ($dir->mkdirs()) {
                    echo "[INFO] Successfully created folder (bundle)\n";
                } else {
                    echo "[ERROR] Error create folder | CODE: 0x0030kqyc\n";
                    alert("Ошибка создания папки ".$folder_projects."/".$this->e1->text."/bundle"." | CODE: 0x0030kqyc");
                    app()->shutdown();
                }
                
                // folder vendor
                $dir = new File($folder_projects."/".$this->e1->text."/vendor");
    
                if ($dir->mkdirs()) {
                    echo "[INFO] Successfully created folder (vendor)\n";
                } else {
                    echo "[ERROR] Error create folder | CODE: 0x0031kqyc\n";
                    alert("Ошибка создания папки ".$folder_projects."/".$this->e1->text."/vendor"." | CODE: 0x0031kqyc");
                    app()->shutdown();
                }
                
                app()->module("design")->ini->set("version",$this->e3->text);
                app()->module("design")->ini->set("name",$this->e1->text);
                app()->module("design")->ini->set("icon","develnext/bundle/".$this->e1->text."/icon.png");
                app()->module("design")->ini->set("author",$this->e2->text);
                app()->module("design")->ini->set("description",$this->e5->text."\n".$this->e6->text);
                app()->module("design")->ini->set("class","develnext"."\\"."\\"."bundle"."\\"."\\".$this->e1->text."\\"."\\".$this->e1->text."Bundle");
                app()->module("design")->ini->set("group",$this->listView->selectedItem);
                fs::copy(fs::abs('./')."\\.resource", $folder_projects."/".$this->e1->text."/.resource");
                unlink('.resource');
                
                fs::copy($this->e4->text, $folder_projects."/".$this->e1->text."/vendor/icon.png");
                fs::copy($this->e7->text, $folder_projects."/".$this->e1->text."/vendor/desc.html");
                
                app()->form("new")->toast("Проект создан.");
                waitAsync(2000, function () use ($e, $event) {
                    app()->form("new")->free();
                });
            }
        
        
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $a = app()->module("design")->fileChooserAlt->execute();
        $this->e4->text = $a;
        $img = new UXImage($a);
        $this->image->image = $img;
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
        $a = app()->module("design")->fileChooser->execute();
        $this->e7->text = $a;
    }


}
