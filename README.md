![PHP](https://img.shields.io/badge/php-474A8A.svg?style=for-the-badge&logo=php&logoColor=white)
[![License](https://img.shields.io/github/license/vrglab/PhpIoUtils?style=for-the-badge)](LICENSE.txt) 
[![Releases](https://img.shields.io/github/v/release/vrglab/PhpIoUtils?style=for-the-badge)](https://github.com/vrglab/PhpIoUtils/releases)

# PhpIoUtils
A Library for improved io functionality within PHP

Usage Example for file creation: 
```php
  $filePath  = __DIR__ . '/somedir/someFile.file'
    
  $result = File::create($filePath);

  if($result) {
    'File made successfully'
  }

'File already existed or creation failed'
```

## Requirements
- Php 8.5+
- Composer
- [Task](https://taskfile.dev)


