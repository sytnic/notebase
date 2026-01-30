
## Установка на Ububntu

https://jekyllrb.com/docs/installation/ubuntu/

    sudo apt-get install ruby-full
    (?, пропустить) sudo apt-get install gem
    sudo apt-get install build-essential
    sudo apt-get install zlib1g-dev
    sudo gem install bundler
    sudo gem install jekyll

## Проверка

    ruby -v (ruby --version, must be > 2.5.0)
    gem -v
    gcc -v
    g++ -v
    make -v
    bundler -v
    jekyll -v

## Установка сайта

Создаётся Gemfile

    bundle init

Редактируется Gemfile, добавляется одна строка, строго эта.

    gem "jekyll"

Создается Gemfile.lock.

    bundle

Создается сайт. Создаются папки .jekyll и _site .

    jekyll build


