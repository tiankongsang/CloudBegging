# CloudBegging
云讨饭 for Payease

## 环境
开发环境 PHP7.2, 好像5.4+都可以的样子

## 搭建
栗子：
```
cd /www/wwwroot/donate.example.com/
git clone -b payease https://github.com/WooMai/CloudBegging ./tmp
mv ./tmp/.git ./
git reset --hard HEAD
rm -rf ./tmp
chmod 777 ./data
cp config.example.php config.php
vi config.php
```

## Licence
MIT
