N86io/Reflection documentation
==============================

Install
=======

In order to use these packages, please read `composer documentation
<https://getcomposer.org/doc>`_ on how to use composer and packages for it.

Package name for this package is ``n86io/reflection``.

Usage
=====

The reflection-classes from this package are used the same way as the php build-in reflection classes but with several
additions. Only the class ReflectionObject is not wrapped by this package.

getParsedDocComment()
---------------------

The following classes have the additional method ``getParsedDocComment()``: ReflectionClass, ReflectionFunction,
ReflectionMethod, ReflectionProperty. Return object is of type \\N86io\\Reflection\\DocComment.

You can get doc-comment summary, description and tag-values.

ReflectionProperty
------------------

The class ReflectionProperty has additional methods: ``hasGetter()``, ``getGetter()``, ``hasSetter()``,
``getSetter()``. For further information please read the `source code of ReflectionProperty
<https://github.com/n86io/reflection/blob/master/src/ReflectionProperty.php>`_.

API Documentation
=================

Coming soon...
