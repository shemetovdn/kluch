nestedSortable Yii2 jQuery plugin
=================================
**nestedSortable** is a jQuery plugin that extends jQuery Sortable UI functionalities to nested lists.  
Forked from https://github.com/ilikenwf/nestedSortable

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist datacentrix/yii2-nested-sortable "*"
```

or add

```
"datacentrix/yii2-nested-sortable": "*"
```

to the require section of your `composer.json` file.

Features
--------
- Designed to work seamlessly with the [nested](http://articles.sitepoint.com/article/hierarchical-data-database "A Sitepoint tutorial on PHP, MYSQL and nested sets") [set](http://en.wikipedia.org/wiki/Nested_set_model "Wikipedia article on nested sets") model (have a look at the `toArray` method)
- Items can be sorted in their own list, moved across the tree, or nested under other items.
- Sublists are created and deleted on the fly
- All jQuery Sortable options, events and methods are available
- It is possible to define elements that will not accept a new nested item/list and a maximum depth for nested items
- The root level can be protected
- The parentship of items can be locked, just as if it was a family tree.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \datacentrix\sortable\AutoloadExample::widget(); ?>```