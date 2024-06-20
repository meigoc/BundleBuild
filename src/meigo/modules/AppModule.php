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
        // все выводы в лог (консоль) на английском языке, т.к. на данный момент я не знаю как сделать поддержку русского текста в командной строке windows
        // форма
        global $Form;
        // глобальные переменные
        global $ver;
        global $JAVA_HOME;
        global $TEMP;
        global $USERPROFILE;
        // папки проектов
        global $folder_projects;
        
        $ver = "v0.9.3_beta"; // версия программы
        $JAVA_HOME = $_ENV['JAVA_HOME']; // Путь к джаве
        $TEMP = $_ENV['TEMP']; // TEMP-папка
        $USERPROFILE = $_ENV['USERPROFILE']; // Путь к пользовательской папке типа: C:/Users/User/ (запись всегда разрешена)
        
        echo "BundleBuild ".$ver." launched!\n";
        echo "------------------\n";
        echo "APP UUID: ".app()->getConfig()->get("app.uuid")."\n";
        echo "StartTime: ".app()->getStartTime()."\n";
        echo "Java: ".$JAVA_HOME."\n";
        echo "PHP: ".phpversion()."\n";
        echo "JPHP: 1.0.3\n";
        echo "------------------\n";
        echo "LOG HERE:\n";
        
        // папки
        $nfolder_projects = $USERPROFILE."\\BundleBuildProjects"; // папка проектов
        $nfolder_library = $USERPROFILE."\\BundleBuildLibrary"; // папка библиотек
        // из \ в / методом str:replace
        //  Было: C:\Users\User\papka
        // Стало: C:/Users/User/papka
        $folder_projects = str::replace($nfolder_projects, "\\", "/");
        $folder_library = str::replace($nfolder_library, "\\", "/");
        app()->module("design")->fileChooser3->initialDirectory = $folder_projects;
        echo "[INFO] Projects: ".$folder_projects." | Library: ".$folder_library." \n";
        // Создание папки проектов BundleBuild
        if (fs::isDir($folder_projects)) {
            echo "[INFO] Searching... (1/2)\n";
        } else {
            echo "[ERROR] Project folder not found, creating a new...\n";
            $dir = new File($folder_projects);

            if ($dir->mkdirs()) {
                echo "[INFO] Successfully created folder (1/2)\n";
            } else {
                echo "[ERROR] Error create folder | CODE: 0x0008kabc\n";
                alert("Ошибка создания папки ".$folder_projects." | CODE: 0x0008kabc");
                app()->shutdown();
            }
        }
        // Создание папки библиотеки BundleBuild
        if (fs::isDir($folder_library)) {
            echo "[INFO] Searching... (2/2)\n";
        } else {
            echo "[ERROR] Library folder not found, creating a new...\n";
            $dir = new File($folder_library);

            if ($dir->mkdirs()) {
                echo "[INFO] Successfully created folder (2/2)\n";
            } else {
                echo "[ERROR] Error create folder | CODE: 0x0008kabc\n";
                alert("Ошибка создания папки ".$folder_library." | CODE: 0x0008kabc");
                app()->shutdown();
            }
        }
        // Создание папки для временных файлов (temp)
        //
        // будет добавлено в следующей версии
        //
        
        
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
        // Создание панели
        app()->module("design")->AddPanel($Form);
        // Создание дерева
        app()->module("design")->AddTree($Form);
        
        // Создание двух текстов
        $text1 = new UXLabel;
        $text1->size = [416, 36];
        $text1->position = [168, 72];
        $text1->text = "Добро пожаловать в BundleBuild";
        $text1->font = $text1->font->withBold()->withSize(25);
        $Form->add($text1);
        
        $text2 = new UXLabel;
        $text2->size = [416, 200];
        $text2->position = [168, 105];
        $text2->text = 'версия сборки: v0.9.3_beta;
- Глобальное обновление дизайна главной формы,        
- Добавлено открытие проектов,
- В главной форме, в меню "Проект" теперь не доступны кнопки связанные с сохранением когда проект не открыт,
- Добавлено меню "Справка" и "Язык".';
        $text2->alignment = "TOP_LEFT";
        $text2->wrapText = true;
        $text2->font = $text2->font->withSize(15)->withRegular()->withName('Calibri');
        $Form->add($text2);
    }


}
