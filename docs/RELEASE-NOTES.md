# Semantic MediaWiki 2.2

This is not a release yet.

## New features

* #770 Added the `--no-cache` option to `rebuildData.php` and the `--debug` option to `rebuildData.php` and `rebuildConceptCache.php` (refs #749, #766)
* #756 Added template support for the `#set` parser
* #783 Added support for `wgCategoryCollation` setting in `CategoryResultPrinter` (#699, T40853)
* #886 Extended rules on how an `ImportValue` need to contain a valid type definition
* #891 Enforces strict type declaration for properties with import references (type of the imported reference takes precedence over any user-defined type declaration)
* #892 Added support for `<swivt:file>` in order for a RDF export to point to a "real" file resource
* #893 Added information about "improper value for" to the statistics overview and as `API` parameter (`&errorcount`)

## Bug fixes

* #764 Fixed DB error when a `#ask` query contains `order=random` for a `sqlite` or `postgres` DB platform (disabled `smwgQRandSortingSupport` for `postgres`)
* #860 Fixed escape character usage in `SPARQLStore`, `SQLStore` 
* #860 Fixed handling of an empty result send by the `SPARQLStore` Sesame connector
* #861 Fixed owl property export declaration
* #863 Fixed missing interwiki encoding for the RDF export
* #864 Fixed empty searchlabel raw wikitext display for a `QueryResultPrinter` with `limit=0`
* #882 Fixed exception in `SMWExportController` caused by an empty property reference
* #884 Fixed fetching of import vocabularies to be language independent
* #887 Fixed `pre` element rendering for the template "furtherresult" output link
* #896 Fixed empty caption for `false` when using the`#x` format option

## Internal changes
* #373 Update `jquery.jstorage.js` (0.3.2 => 0.4.11)
* #494 Changes to the `SQLStore\QueryEngine` interface
* #711 Fetching annotations made by an `#ask` transcluded template 
* #725 Moved psr-4 complaint classes into the top level 'src' folder
* #740 Added `serialization/serialization:~3.2` component dependency
* #771 Added `doctrine/dbal:~2.5` component dependency
* #772 Added `onoi/message-reporter:~1.0` component dependency
* #777 Moved all concept related code into a separate `ConceptCache` class
* #884 Added `ControlledVocabularyImportFetcher` to isolate import vocabulary fetching from the `DVImport` object
* #883 Added `CircularReferenceGuard` to monitor possible self/circular references in ask templates
