PHP-Instagram-effects
=====================

PHP class for photo effects similar to Instagram

## Usage

```php
require 'src/Image/Filter.php';

$image = imagecreatefromjpeg("/path/to/image.jpg");

$filter = (new vcImageFilter($image))->aqua();

header('Content-type: image/jpeg');
imagejpeg($filter->getImage());
```

Examples of usage are in the `examples` directory. To generate example images, this bash snippet may be helpful:

```shell
for f in *.php; do php $f > ${f%.php}.png; done
```
