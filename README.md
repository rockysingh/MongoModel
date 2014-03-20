MongoModel
=============

## Introduction

This is a PHP Class that can be extended if you would like make individual models/domain classes for your collection.

## Basic example of usage

class Article extends MongoModel {

    public function __construct(){

        parent::__construct("article");
    }

    public function hasArticle($link) {
        $article =  $this->find(
                    array('url' => $link)
        );

        return (is_array($article) && count($article) > 0);
    }

}