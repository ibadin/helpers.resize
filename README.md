# helpers.resize
Помощник для работы с изображениями в Битрикс
# ImageSettings
Для начала работы нужно создать экземпляр класса настроек для ресайзинга изображений ImageSettings
Экземпляр можно создать следующим образоом:

``` 
$imageSettings = ImageSettings::withSize("500x500")
                                ->setHolderSize("16x16")
                                ->setBlur(false)
                                ->setResizeType(ImageResizeTypes::PROPORTIONAL_ALT)
```
В этом примере мы установили для выходного изображения размеры 500x500, установили размер для заглушки 16x16 (заглушка это изображение, которое вы можете вставить, когда пользуетесь LazyLoad, чтобы сначала загрузилась маленькая картинка, а затем когда нужно подгрузится большая. Методом setBlur(false) мы отключили блюр у миниатюры. Метод setResizeType(ImageResizeTypes::PROPORTIONAL_ALT)устанавливает тип масштабирования [ссылка](https://dev.1c-bitrix.ru/api_help/main/reference/cfile/resizeimageget.php).

Далее передадим id изображения и настройки класс резайзер и вызовем метод resize()

# ImageResize
```
$imageResize = ImageResize::init($id, $imageSettings)->resize();
```

Метод resize() вернет массив вида:
``` 
IMAGE
  =>BASE64
  =>SRC
  =>WIDTH
  =>HEIGHT
HOLDER
  =>BASE64
  =>SRC
  =>WIDTH
  =>HEIGHT
```

# ImageResizeCollection
Класс для того, чтобы уменьшить сразу несколько изображений

Например, у нас есть массив id изображений,например, 49057, 49056, нам нужно для каждого из этих id получить большое изображение и среднее:
```
$settingsLarge = ImageSettings::withSize("1024x768"); // Задаем настройки для большого изображения
$settingsMedium = ImageSettings::withSize("500x500"); // Задаем настройки для среднего изображения
                                
$arCollection = ImageResizeCollection::byIds([49057, 49056])
                                       ->addSize("LARGE", settingsLarge)
                                       ->addSize("MEDIUM", $settingsMedium)
                                       ->resize();
```


Метод resize() вернет массив вида:
``` 
49057
  LARGE
    IMAGE
      =>BASE64
      =>SRC
      =>WIDTH
      =>HEIGHT
    HOLDER
      =>BASE64
      =>SRC
      =>WIDTH
      =>HEIGHT
49056
  MEDIUM
      IMAGE
      =>BASE64
      =>SRC
      =>WIDTH
      =>HEIGHT
    HOLDER
      =>BASE64
      =>SRC
      =>WIDTH
      =>HEIGHT
```
