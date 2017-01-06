N86io/Reflection documentation
==============================

Install
=======

For using this packages, please read `composer documentation
<https://getcomposer.org/doc>`_ how to use composer and packages for it.

Package name for this package is ``n86io/reflection``.

Usage
=====

The usage of the reflection-classes from this package is the same as the php build-in reflection classes with several
additions. Only the class ReflectionObject was not wrapped by this package.

getParsedDocComment()
---------------------

The following classes have additional method ``getParsedDocComment()``: ReflectionClass, ReflectionFunction,
ReflectionMethod, ReflectionProperty. Return object is of type \\N86io\\Reflection\\DocComment.

You can get doc-comment summary, description and tag-values.

ReflectionProperty
------------------

The class ReflectionProperty has still further methods: ``hasGetter()``, ``getGetter()``, ``hasSetter()``,
``getSetter()``. Please read for further information the `source code of ReflectionProperty
<https://github.com/n86io/reflection/blob/master/src/ReflectionProperty.php>`_.

API Documentation
=================

Coming soon...
