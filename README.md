# Automad Meta Tags Extension

This extension creates a couple of meta tags and a `<title></title>` tag for the `<head></head>` section in a template. The following meta tags are supported:

* `og:type`  
* `og:url` 
* `og:image`
* `og:title`
* `og:description`
* `description`

## Usage

The extension can be used in templates as follows:

	<@ Automad/MetaTags { options } @>
		
## Options 

The following options are available:

* `title`: The meta title. By default a combination of the `sitename` and `title` variables is used.
* `description`: The meta description. By default there is no description. Any variable can be used.
* `ogTitle`: The open graph title. Like with the `title` option, a combination of the `sitename` and `title` variables is used.
* `ogDescription`: The open graph description. By default there is no description. Any variable can be used.
* `ogType`: The open graph type. The default is 'website'.
* `ogImage`: The open graph image. By default there is no image defined. Any variable or string can be used here. It is possible to use an external URL to an image as well as a glob pattern to a local image. 

## Example

A full example for using this extension in the `<head></head>` section looks as follows:

	<head>
	<@ Automad/MetaTags { 
		title: @{ metaTitle | def('@{ sitename } / @{ title }') },
		description: @{ metaDescription | def(@{ text | stripTags }) },
		ogTitle: @{ ogTitle | def('@{ sitename } / @{ title }') },
		ogDescription: @{ ogDescription | def(@{ text | stripTags }) },
		ogType: 'website',
		ogImage: @{ ogImage | def('/shared/og*.png') }
	} @>
	<# Add some CSS or JS tags here ... #>
	</head>